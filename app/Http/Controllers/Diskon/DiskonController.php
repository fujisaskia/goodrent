<?php

namespace App\Http\Controllers\Diskon;

use App\Http\Controllers\Controller;
use App\Models\Diskon;
use App\Models\KategoriDiskon;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $diskons = Diskon::with('kategori')
            ->when($search, function ($query, $search) {
                $query->where('nama_diskon', 'like', "%{$search}%")
                      ->orWhereHas('kategori', function ($q) use ($search) {
                          $q->where('nama', 'like', "%{$search}%");
                      });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        $kategoriDiskons = KategoriDiskon::all();
    
        return view('admin.diskon.index', compact('diskons', 'kategoriDiskons'));
    }
    
    public function create()
    {
        $kategoriDiskons = KategoriDiskon::all(); // Ambil semua kategori diskon untuk dropdown
        return view('admin.diskon.create', compact('kategoriDiskons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_diskon' => 'required|string|max:255',
            'kategori_diskon_id' => 'required|exists:kategori_diskons,id',
            'besar_diskon' => 'required|numeric|min:0', // sudah tidak pakai persen
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Ambil kategori dari relasi
        $kategori = KategoriDiskon::find($request->kategori_diskon_id);

        // Generate kode
        $kodeDiskon = Diskon::generateKodeDiskon($kategori->nama);

        // Hitung durasi hari
        $tanggalMulai = \Carbon\Carbon::parse($request->tanggal_mulai);
        $tanggalSelesai = \Carbon\Carbon::parse($request->tanggal_selesai);
        $durasiHari = $tanggalMulai->diffInDays($tanggalSelesai);
        $durasiHari = $durasiHari === 0 ? 1 : $durasiHari; // Jika sama, dianggap 1 hari

        // Simpan ke database
        Diskon::create([
            'nama_diskon' => $request->nama_diskon,
            'kode_diskon' => $kodeDiskon,
            'kategori_diskon_id' => $request->kategori_diskon_id,
            'besar_diskon' => $request->besar_diskon,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'durasi_hari' => $durasiHari, // pastikan kolom ini ada di tabel
        ]);

        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $diskon = Diskon::findOrFail($id);
        $kategoriDiskons = KategoriDiskon::all(); // Ambil semua kategori diskon untuk dropdown
        return view('admin.diskon.edit', compact('diskon', 'kategoriDiskons'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_diskon' => 'required|string|max:255',
            'kategori_diskon_id' => 'required|exists:kategori_diskons,id',
            'besar_diskon' => 'required|numeric|min:0|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Ambil data kategori_diskon
        $kategori = KategoriDiskon::findOrFail($request->kategori_diskon_id);

        // Generate ulang kode_diskon dari kategori dan nama diskon
        $kode_diskon = Diskon::generateKodeDiskon($kategori->kode, $request->nama);

        // Hitung durasi hari
        $tanggalMulai = \Carbon\Carbon::parse($request->tanggal_mulai);
        $tanggalSelesai = \Carbon\Carbon::parse($request->tanggal_selesai);
        $durasiHari = $tanggalMulai->diffInDays($tanggalSelesai);
        $durasiHari = $durasiHari === 0 ? 1 : $durasiHari; // Jika sama, dianggap 1 hari

        // Ambil diskon yang akan diupdate
        $diskon = Diskon::findOrFail($id);

        // Update data diskon
        $diskon->update([
            'nama_diskon' => $request->nama_diskon,
            'kode_diskon' => $kode_diskon,
            'kategori_diskon_id' => $request->kategori_diskon_id,
            'besar_diskon' => $request->besar_diskon,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'durasi_hari' => $durasiHari, // pastikan kolom ini ada di tabel
        ]);

        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Hapus diskon dari database
        $diskon = Diskon::findOrFail($id);
        $diskon->delete();

        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil dihapus.');
    }

    public function destroySelected(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'exists:diskons,id',
        ]);

        Diskon::whereIn('id', $request->ids)->delete();

        return redirect()->route('diskon.index')->with('success', 'Data diskon yang dipilih berhasil dihapus.');
    }


    // Apply discount
    public function applyDiscount(Request $request)
    {
        $user = auth()->user();
        $pesanan = $user->pesanans()->latest()->first();

        if (!$pesanan) {
            return response()->json(['error' => 'Pesanan tidak ditemukan'], 400);
        }

        // Temukan diskon berdasarkan ID
        $diskon = Diskon::find($request->diskon_id);
        if (!$diskon) {
            return response()->json(['error' => 'Diskon tidak valid'], 400);
        }

        // Hitung potongan harga
        // $potonganHarga = ($diskon->besar_diskon / 100) * $pesanan->total_bayar;
        $potonganHarga = $diskon->besar_diskon;
        $totalBayar = $pesanan->total_bayar - $potonganHarga;

        // Update pesanan dengan diskon
        $pesanan->diskon_id = $diskon->id;
        $pesanan->potongan_harga = $potonganHarga;
        $pesanan->total_bayar = $totalBayar;
        $pesanan->save();

        // Kirimkan response dengan total bayar yang telah diperbarui
        return response()->json(['success' => true, 'total_bayar' => number_format($totalBayar, 0, ',', '.')]);
    }
}

<?php

namespace App\Http\Controllers\Barang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang; // Add the Barang model
use App\Models\HargaSewa;
use App\Models\KategoriBarang;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $barangs = Barang::with('hargaSewas')
            ->when($search, function ($query, $search) {
                $query->where('nama_barang', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        $kategoriBarangs = KategoriBarang::all();
    
        return view('admin.data-barang.index', compact('barangs', 'kategoriBarangs'));
    }

    public function create()
    {
        $kategoriBarangs = KategoriBarang::all();
        return view('admin.data-barang.create', compact('kategoriBarangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori_barang_id' => 'required|exists:kategori_barangs,id',
            'deskripsi' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        // Generate kode barang otomatis
        $kode_barang = Barang::generateKodeBarang($request->kategori_barang_id);

        // Simpan gambar ke storage
        $image = $request->file('image');
        $image->storeAs('barangs', $image->hashName(), 'public');

        // Status berdasarkan stok
        $status_barang = $request->stok > 0 ? 'Tersedia' : 'Tidak Tersedia';

        // Simpan data barang
        $barang = Barang::create([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $kode_barang,
            'kategori_barang_id' => $request->kategori_barang_id,
            'deskripsi' => $request->deskripsi,
            'image' => $image->hashName(),
            'harga' => $request->harga,
            'stok' => $request->stok,
            'status_barang' => $status_barang,
        ]);

        // Simpan harga sewa berdasarkan durasi
        $durasiList = [12, 24, 72, 168]; // durasi dalam jam

        foreach ($durasiList as $durasi) {
            $harga = $this->hitungHargaSewa($request->harga, $durasi);
            HargaSewa::create([
                'barang_id' => $barang->id,
                'durasi_jam' => $durasi,
                'harga' => $harga,
            ]);
        }

        return redirect()->route('data-barang.index')->with('success', 'Barang dan harga sewa berhasil ditambahkan.');
    }

    // Fungsi untuk menghitung harga sewa berdasarkan durasi (jangan dibuat routnya)
    public function hitungHargaSewa($hargaPerHari, $durasiJam)
    {
        switch ($durasiJam) {
            case 12:
                return $hargaPerHari / 2; // harga sewa untuk 12 jam
            case 24:
                return $hargaPerHari; // harga sewa untuk 1 hari (24 jam)
            case 72:
                return $hargaPerHari * 3; // harga sewa untuk 3 hari (72 jam) tanpa diskon
            case 168:
                return $hargaPerHari * 7; // harga sewa untuk 7 hari (168 jam) tanpa diskon
            default:
                return $hargaPerHari; // jika tidak cocok, anggap durasi adalah 1 hari (24 jam)
        }
    }

    public function editData($id)
    {
        $barang = Barang::find($id);
        $harga24jam = $barang->hargaSewas->where('durasi_jam', 24)->first()?->harga;

        \Log::info("Mengambil barang id: " . $id);

    
        if (!$barang) {
            return response()->json(['error' => 'Data barang tidak ditemukan'], 404);
        }
    
        return response()->json([
            'id' => $barang->id,
            'nama_barang' => $barang->nama_barang,
            'kategori_barang_id' => $barang->kategori_barang_id,
            'kode_barang' => $barang->kode_barang,
            'deskripsi' => $barang->deskripsi,
            'harga' => $harga24jam,
            'stok' => $barang->stok,
            'image' => $barang->image ? asset('storage/barangs/' . $barang->image) : null,
        ]);
    }
    
    public function update(Request $request)
    {
        $barang = Barang::findOrFail($request->id);

        $request->validate([
            'nama_barang' => 'required',
            'kategori_barang_id' => 'required|exists:kategori_barangs,id',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric',
            'stok' => 'required|integer|min:0',
        ]);

        // Tentukan status barang otomatis
        $status_barang = $request->stok > 0 ? 'Tersedia' : 'Tidak Tersedia';

        // Jika ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($barang->image && Storage::exists('public/barangs/' . $barang->image)) {
                Storage::delete('public/barangs/' . $barang->image);
            }

            // Simpan gambar baru
            $image = $request->file('image');
            $imageName = $image->hashName(); // Nama file unik
            $image->storeAs('public/barangs', $imageName);

            // Simpan nama file ke model
            $barang->image = $imageName;
        }

        // Update data barang
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kategori_barang_id' => $request->kategori_barang_id,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'status_barang' => $status_barang,
            'image' => $barang->image, // tetap gunakan yang disimpan tadi (jika ada)
        ]);

        // Hapus harga sewa lama dulu (agar tidak dobel)
        HargaSewa::where('barang_id', $barang->id)->delete();

        // Simpan ulang harga sewa baru berdasarkan durasi
        $durasiList = [12, 24, 72, 168];

        foreach ($durasiList as $durasi) {
            $harga = $this->hitungHargaSewa($request->harga, $durasi);

            HargaSewa::create([
                'barang_id' => $barang->id,
                'durasi_jam' => $durasi,
                'harga' => $harga,
            ]);
        }

        return redirect()->route('data-barang.index')->with('success', 'Barang dan harga sewa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        // Hapus gambar dari storage
        if ($barang->image) {
            Storage::delete('public/barangs/' . $barang->image);
        }

        // Hapus data barang dari database
        $barang->delete();

        return redirect()->route('data-barang.index')->with('success', 'Barang berhasil dihapus.');
    }   

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        $harga24jam = $barang->hargaSewas()->where('durasi_jam', 24)->value('harga');
    
        return response()->json([
            'barang' => $barang,
            'harga24jam' => $harga24jam,
        ]);
    }    

    public function lihatBarang(Request $request)
    {
        $query = Barang::query();
    
        if ($request->has('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }
    
        $barangs = $query->latest()->take(10)->get();
    
        return view('user.index', compact('barangs'));
    }
    

    public function barangLandingPage()
    {
        $barangs = Barang::latest()->take(10)->get(); // ambil max 12 barang
        return view('welcome', compact('barangs'));
    }

    public function getKodeBarang($kategoriId)
    {
        try {
            $kodeBarang = \App\Models\Barang::generateKodeBarang($kategoriId);
            return response()->json(['kode_barang' => $kodeBarang]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function destroySelected(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'exists:barangs,id',
        ]);

        // Ambil data barang terlebih dahulu agar bisa menghapus file image jika ada
        $barangs = Barang::whereIn('id', $request->ids)->get();

        foreach ($barangs as $barang) {
            // Hapus image dari storage jika ada
            if ($barang->image && Storage::exists('public/barangs/' . $barang->image)) {
                Storage::delete('public/barangs/' . $barang->image);
            }

            // Hapus juga relasi harga sewa jika ada
            $barang->hargaSewas()->delete();
        }

        // Hapus data barang
        Barang::whereIn('id', $request->ids)->delete();

        return redirect()->route('data-barang.index')->with('success', 'Barang yang dipilih berhasil dihapus.');
    }
}

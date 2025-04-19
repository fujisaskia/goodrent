<?php

namespace App\Http\Controllers\Checkout;

use App\Models\Diskon;
use App\Models\Pesanan;
use App\Models\CheckOut;
use App\Models\Keranjang;
use App\Models\PesananItem;
use Illuminate\Http\Request;
use App\Models\KeranjangItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    // public function checkoutItems()
    // {
    //     $user = Auth::user();

    //     $keranjang = Keranjang::with('items.barang.hargaSewas')->where('user_id', $user->id)->first();

    //     if (!$keranjang || $keranjang->items->isEmpty()) {
    //         return redirect()->back()->with('error', 'Keranjang Anda kosong.');
    //     }

    //     DB::beginTransaction();

    //     try {
    //         $totalBayar = 0;

    //         // Simpan ke tabel pesanans
    //         $pesanan = Pesanan::create([
    //             'user_id' => $user->id,
    //             'total_bayar' => 0, // sementara, akan diupdate nanti
    //         ]);

    //         foreach ($keranjang->items as $item) {
    //             // Cari harga berdasarkan durasi sewa
    //             $harga = $item->barang->hargaSewas
    //                 ->where('durasi_jam', $item->durasi_sewa)
    //                 ->first()
    //                 ->harga ?? 0;

    //             $totalBayar += $harga;

    //             PesananItem::create([
    //                 'pesanan_id' => $pesanan->id,
    //                 'barang_id' => $item->barang->id,
    //                 'durasi_sewa' => $item->durasi_sewa,
    //                 'tanggal_mulai' => $item->tanggal_mulai,
    //                 'tanggal_selesai' => $item->tanggal_selesai,
    //                 'harga_barang' => $harga,
    //                 'subtotal' => $harga, // tidak dikali durasi
    //             ]);
    //         }

    //         // Update total bayar
    //         $pesanan->update([
    //             'total_bayar' => $totalBayar,
    //         ]);

    //         // Kosongkan keranjang
    //         $keranjang->items()->delete();

    //         DB::commit();

    //         return redirect()->route('checkout.summary')->with('success', 'Checkout berhasil!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->back()->with('error', 'Checkout gagal: ' . $e->getMessage());
    //     }
    // }

    public function checkoutItems()
{
    $user = Auth::user();

    $keranjang = Keranjang::with('items.barang.hargaSewas')->where('user_id', $user->id)->first();

    if (!$keranjang || $keranjang->items->isEmpty()) {
        return redirect()->back()->with('error', 'Keranjang Anda kosong.');
    }

    DB::beginTransaction();

    try {
        $totalBayar = 0;

        // Simpan ke tabel pesanans
        $pesanan = Pesanan::create([
            'user_id' => $user->id,
            'total_bayar' => 0,
        ]);

        foreach ($keranjang->items as $item) {
            $harga = $item->barang->hargaSewas
                ->where('durasi_jam', $item->durasi_sewa)
                ->first()
                ->harga ?? 0;

            $totalBayar += $harga;

            PesananItem::create([
                'pesanan_id' => $pesanan->id,
                'barang_id' => $item->barang->id,
                'durasi_sewa' => $item->durasi_sewa,
                'tanggal_mulai' => $item->tanggal_mulai,
                'tanggal_selesai' => $item->tanggal_selesai,
                'harga_barang' => $harga,
                'subtotal' => $harga,
            ]);
        }

        $pesanan->update([
            'total_bayar' => $totalBayar,
        ]);

        $keranjang->items()->delete();

        DB::commit();

        // Redirect ke halaman checkout dengan ID pesanan
        return redirect()->route('checkout.summary', ['id' => $pesanan->id])
            ->with('success', 'Checkout berhasil!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Checkout gagal: ' . $e->getMessage());
    }
}


    public function checkoutCancelled(Pesanan $pesanan)
    {
        DB::beginTransaction();

        try {
            $user = auth()->user();

            // Ambil atau buat keranjang user
            $keranjang = Keranjang::firstOrCreate(['user_id' => $user->id]);

            // Kembalikan item dari pesanan ke keranjang
            foreach ($pesanan->items as $item) {
                KeranjangItem::create([
                    'keranjang_id' => $keranjang->id,
                    'barang_id' => $item->barang_id,
                    'tanggal_mulai' => $item->tanggal_mulai,
                    'tanggal_selesai' => $item->tanggal_selesai,
                    'durasi_sewa' => $item->durasi_sewa,
                ]);
            }

            // Hapus pesanan dan relasi itemnya
            $pesanan->items()->delete();
            $pesanan->delete();

            DB::commit();

            return redirect()->route('keranjang.index')->with('success', 'Checkout dibatalkan dan item dikembalikan ke keranjang.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membatalkan checkout: ' . $e->getMessage());
        }
    }

    public function checkoutSummary($id)
    {
        $pesanan = auth()->user()->pesanans()->latest()->with('items.barang')->first();
        $pesanan = Pesanan::with('items.barang', 'diskon.kategori')->findOrFail($id);

        if (!$pesanan) {
            return redirect()->route('keranjang.index')->with('error', 'Tidak ada pesanan ditemukan.');
        }

        // Mengambil data diskon yang tersedia
        $diskons = Diskon::with('kategori')->get();

        return view('user.checkout', compact('pesanan', 'diskons'));
    }



    // public function index()
    // {
    //     $user = Auth::user();

    //     // Ambil semua checkout yang terkait dengan user
    //     $checkouts = CheckOut::whereHas('keranjang', function ($query) use ($user) {
    //         $query->where('user_id', $user->id);
    //     })->orderBy('created_at', 'desc')->paginate(10);

    //     return view('user.checkout.index', compact('checkouts'));
    // }

    // public function create($keranjangId)
    // {
    //     $keranjang = Keranjang::findOrFail($keranjangId);

    //     // Ambil item dari keranjang yang sudah dipilih
    //     $selectedItems = $keranjang->keranjangItems;

    //     if ($selectedItems->isEmpty()) {
    //         return redirect()->route('keranjang.index')->with('error', 'Tidak ada item untuk diproses.');
    //     }

    //     // Menampilkan halaman checkout dengan data item keranjang
    //     return view('user.checkout', compact('keranjang', 'selectedItems'));
    // }

    // public function store(Request $request)
    // {
    //     $user = Auth::user();

    //     // Ambil keranjang berdasarkan user yang sedang login
    //     $keranjang = Keranjang::where('user_id', $user->id)->first();

    //     if (!$keranjang) {
    //         return redirect()->back()->with('error', 'Keranjang tidak ditemukan.');
    //     }

    //     // Ambil item dari keranjang
    //     $selectedItems = $keranjang->keranjangItems;

    //     // Buat data checkout
    //     $checkout = new \App\Models\CheckOut();
    //     $checkout->keranjang_id = $keranjang->id;
    //     $checkout->total_bayar = $selectedItems->sum('harga');
    //     $checkout->metode_pembayaran = $request->input('metode_pembayaran', 'Transfer'); // Bisa diganti sesuai form
    //     $checkout->save();

    //     // Setelah checkout selesai, kita bisa menghapus keranjang jika diinginkan
    //     $keranjang->delete();

    //     return redirect()->route('checkout.show', $checkout->id)->with('success', 'Checkout berhasil.');
    // }
}

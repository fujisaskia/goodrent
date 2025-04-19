<?php

namespace App\Http\Controllers\Keranjang;

use App\Models\Barang;
use App\Models\HargaSewa;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Models\KeranjangItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil keranjang milik user dan relasi items + barang + hargaSewa
        $keranjang = Keranjang::with(['items.barang.hargaSewas'])
            ->where('user_id', $user->id)
            ->first();

        // Hitung total harga semua item
        $totalHarga = 0;
        if ($keranjang && $keranjang->items) {
            foreach ($keranjang->items as $item) {
                $harga = $item->barang->hargaSewas
                    ->where('durasi_jam', $item->durasi_sewa)
                    ->first()
                    ->harga ?? 0;
                $totalHarga += $harga;
            }
        }

        return view('user.keranjang', compact('keranjang', 'totalHarga'));
    }



    public function addToCart(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'durasi_jam' => 'required|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $user = Auth::user();

        // Cari atau buat keranjang user
        $keranjang = Keranjang::firstOrCreate([
            'user_id' => $user->id
        ]);

        // Ambil data barang
        $barang = Barang::findOrFail($request->barang_id);

        // Hitung jumlah barang yang disewa dan pembayarannya berhasil
        $jumlahDisewa = DB::table('keranjang_items')
            ->join('keranjangs', 'keranjang_items.keranjang_id', '=', 'keranjangs.id')
            ->join('pesanans', 'keranjangs.user_id', '=', 'pesanans.user_id')
            ->join('pembayarans', 'pesanans.id', '=', 'pembayarans.pesanan_id')
            ->where('keranjang_items.barang_id', $request->barang_id)
            ->where('pembayarans.status_pembayaran', 'Berhasil')
            ->where(function ($query) use ($request) {
                $query->whereBetween('keranjang_items.tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
                    ->orWhereBetween('keranjang_items.tanggal_selesai', [$request->tanggal_mulai, $request->tanggal_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('keranjang_items.tanggal_mulai', '<=', $request->tanggal_mulai)
                            ->where('keranjang_items.tanggal_selesai', '>=', $request->tanggal_selesai);
                    });
            })
            ->count();

        // Cek apakah masih tersedia
        if ($jumlahDisewa >= $barang->stok) {
            return redirect()->back()->with('error', 'Stok barang tidak tersedia pada tanggal yang dipilih.');
        }

        // Ambil harga sewa berdasarkan durasi
        $hargaSewa = HargaSewa::where('barang_id', $request->barang_id)
            ->where('durasi_jam', $request->durasi_jam)
            ->firstOrFail();

        // Masukkan item ke dalam keranjang
        KeranjangItem::create([
            'keranjang_id'    => $keranjang->id,
            'barang_id'       => $request->barang_id,
            'durasi_sewa'     => $request->durasi_jam,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('keranjang.index')->with('success', 'Barang berhasil dimasukkan ke keranjang.');
    }



    public function moveToCheckout(Request $request)
    {
        $user = Auth::user();

        // Ambil keranjang berdasarkan user yang sedang login
        $keranjang = Keranjang::where('user_id', $user->id)->first();

        if (!$keranjang) {
            return redirect()->back()->with('error', 'Keranjang tidak ditemukan.');
        }

        // Ambil item yang ada di keranjang
        $selectedItems = $keranjang->keranjangItems;

        if ($selectedItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        // Redirect ke halaman checkout untuk menyelesaikan proses
        return redirect()->route('checkout.create', ['keranjang_id' => $keranjang->id]);
    }
}

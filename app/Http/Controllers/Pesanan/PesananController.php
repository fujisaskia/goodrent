<?php

namespace App\Http\Controllers\Pesanan;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\HargaSewa;
use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function detailProdukUser($id)
    {
        $barang = Barang::with('hargaSewas')->findOrFail($id);
        return view('user.detail-produk', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'durasi_jam' => 'required|integer',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Ambil harga sewa berdasarkan durasi
        $hargaSewa = HargaSewa::where('barang_id', $request->barang_id)
            ->where('durasi_jam', $request->durasi_jam)
            ->firstOrFail();

        // Simpan ke dalam pesanan
        Pesanan::create([
            'user_id' => auth()->id(),
            'barang_id' => $request->barang_id,
            'durasi_sewa' => $request->durasi_jam,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('keranjang.index')->with('success', 'Pesanan berhasil dibuat.');
    }
}

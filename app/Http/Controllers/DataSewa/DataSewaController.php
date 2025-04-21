<?php

namespace App\Http\Controllers\DataSewa;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;

class DataSewaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pesanans = Pesanan::with(['pembayaran', 'items', 'barang', 'user'])
            ->whereHas('pembayaran', function ($query) {
                $query->whereIn('status_pembayaran', ['Menunggu', 'Berhasil']);
            })
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.data-sewa.index', compact('pesanans'));
    }

    public function show($id)
    {
        $pesanan = Pesanan::with(['user', 'items.barang', 'pembayaran'])->findOrFail($id);
        return response()->json([
            'user' => $pesanan->user,
            'items' => $pesanan->items,
            'pesanan' => [
                'status_pemesanan' => $pesanan->status_pemesanan,
            ],
            'pembayaran' => [
                'status_pembayaran' => $pesanan->pembayaran->status_pembayaran,
            ],
            'potongan_harga' => $pesanan->potongan_harga,
            'total_bayar' => $pesanan->total_bayar,
        ]);
    }

    public function updateStatusDigital(Request $request, $id)
    {
        $pesanan = Pesanan::with('items.barang')->findOrFail($id);

        if ($pesanan->status_pemesanan !== 'Dalam Penyewaan') {
            return redirect()->back()->with('error', 'Status tidak dapat diubah karena sudah bukan Dalam Penyewaan.');
        }

        // Update status pemesanan
        $pesanan->update(['status_pemesanan' => 'Selesai']);

        // Tambahkan kembali stok barang
        foreach ($pesanan->items as $item) {
            if ($item->barang) {
                $barang = $item->barang;
                $barang->stok += 1; // Atau $item->jumlah jika stok berdasarkan kuantitas
                $barang->save();
            }
        }

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui dan stok barang telah ditambahkan kembali.');
    }

    public function updateStatusTunai(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        if ($pembayaran->status_pembayaran !== 'Menunggu') {
            return redirect()->back()->with('error', 'Status tidak dapat diubah karena sudah bukan Menunggu.');
        }

        // Ubah status pembayaran menjadi 'Berhasil'
        $pembayaran->update(['status_pembayaran' => 'Berhasil']);

        // Ubah juga status pemesanan jika relasi tersedia
        if ($pembayaran->pesanan && $pembayaran->pesanan->status_pemesanan === 'Menunggu') {
            $pembayaran->pesanan->update(['status_pemesanan' => 'Dalam Penyewaan']);
        }

        return redirect()->back()->with('success', 'Status pesanan dan pembayaran berhasil diperbarui.');
    }

    public function updateStatusPesananTunai(Request $request, $id)
    {
        $pesanan = Pesanan::with('items.barang')->findOrFail($id);

        if ($pesanan->status_pemesanan !== 'Dalam Penyewaan') {
            return redirect()->back()->with('error', 'Status tidak dapat diubah karena sudah bukan Dalam Penyewaan.');
        }

        // Update status pemesanan
        $pesanan->update(['status_pemesanan' => 'Selesai']);

        // Tambahkan kembali stok barang
        foreach ($pesanan->items as $item) {
            if ($item->barang) {
                $barang = $item->barang;
                $barang->stok += 1; // Atau $item->jumlah jika stok berdasarkan kuantitas
                $barang->save();
            }
        }

        return redirect()->back()->with('success', 'Status pesanan tunai berhasil diperbarui dan stok barang telah ditambahkan kembali.');
    }
}

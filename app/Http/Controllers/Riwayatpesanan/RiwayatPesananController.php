<?php

namespace App\Http\Controllers\Riwayatpesanan;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\RiwayatPesanan;
use App\Http\Controllers\Controller;

class RiwayatPesananController extends Controller
{
    public function userRiwayat()
    {
        $pesanans = Pesanan::with(['items.barang', 'pembayaran'])
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc') // urutkan dari yang terbaru
            ->get();

        return view('user.riwayat', compact('pesanans'));
    }

    public function batalkanPenyewaan($id)
    {
        $pesanan = Pesanan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Hanya bisa dibatalkan jika status belum disewa
        if ($pesanan->status_pemesanan === 'Menunggu') {
            $pesanan->update([
                'status_pemesanan' => 'Dibatalkan',
            ]);

            return redirect()->back()->with('success', 'Penyewaan berhasil dibatalkan.');
        }

        return redirect()->back()->with('error', 'Penyewaan tidak dapat dibatalkan karena sudah dalam proses.');
    }

    public function adminRiwayat()
    {
        $riwayatPesanans = RiwayatPesanan::with(['pesanan', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.data-sewa.index', compact('riwayatPesanans'));
    }

    public function updateStatusSelesai(Request $request, $id)
    {
        $riwayatPesanan = RiwayatPesanan::findOrFail($id);

        if ($riwayatPesanan->status_pemesanan !== 'Dalam Penyewaan') {
            return redirect()->back()->with('error', 'Status tidak dapat diubah karena sudah bukan Dalam Penyewaan.');
        }

        $riwayatPesanan->update(['status_pemesanan' => 'Selesai']);
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function updateStatusDibatalkan(Request $request, $id)
    {
        $riwayatPesanan = RiwayatPesanan::findOrFail($id);

        if ($riwayatPesanan->status_pemesanan !== 'Dalam Penyewaan') {
            return redirect()->back()->with('error', 'Status tidak dapat diubah karena sudah bukan Dalam Penyewaan.');
        }

        $riwayatPesanan->update(['status_pemesanan' => 'Dibatalkan']);
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}

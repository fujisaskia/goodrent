<?php

namespace App\Http\Controllers\Riwayatpesanan;

use App\Http\Controllers\Controller;
use App\Models\RiwayatPesanan;
use Illuminate\Http\Request;

class RiwayatPesananController extends Controller
{
    public function userRiwayat()
    {
        $riwayatPesanans = RiwayatPesanan::with(['pesanan', 'user'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('user.riwayat', compact('riwayatPesanans'));
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

<?php

namespace App\Http\Controllers\Laporan;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::with(['user', 'items.barang', 'pembayaran'])
            ->whereIn('status_pemesanan', ['Selesai', 'Dibatalkan']);
    
        // Filter berdasarkan nama pelanggan
        if (!empty($request->search)) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }
    
        // Filter berdasarkan rentang tanggal
        if (!empty($request->awal_laporan) && !empty($request->akhir_laporan)) {
            try {
                $awalInput = $this->convertBulanKeInggris($request->awal_laporan);
                $akhirInput = $this->convertBulanKeInggris($request->akhir_laporan);
    
                $awalLaporan = Carbon::createFromFormat('d F Y', $awalInput)->startOfDay();
                $akhirLaporan = Carbon::createFromFormat('d F Y', $akhirInput)->endOfDay();
    
                $query->whereBetween('created_at', [$awalLaporan, $akhirLaporan]);
            } catch (\Exception $e) {
                return back()->with('error', 'Format tanggal tidak valid.');
            }
        }
    
        $pesanans = $query->get();
    
        return view('admin.laporan.index', compact('pesanans'));
    }
    
    private function convertBulanKeInggris($tanggal)
    {
        $bulan = [
            'Januari' => 'January',
            'Februari' => 'February',
            'Maret' => 'March',
            'April' => 'April',
            'Mei' => 'May',
            'Juni' => 'June',
            'Juli' => 'July',
            'Agustus' => 'August',
            'September' => 'September',
            'Oktober' => 'October',
            'November' => 'November',
            'Desember' => 'December',
        ];
    
        return strtr($tanggal, $bulan);
    }
    


    public function cetakLaporan(Request $request)
    {
        $query = Pesanan::with(['user', 'items.barang', 'pembayaran'])
            ->whereIn('status_pemesanan', ['Selesai', 'Dibatalkan']);
    
        $awalLaporan = null;
        $akhirLaporan = null;
    
        // Filter nama pelanggan
        if (!empty($request->search)) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }
    
        // Filter tanggal
        if ($request->filled('awal_laporan') && $request->filled('akhir_laporan')) {
            try {
                $awalInput = $this->convertBulanKeInggris($request->awal_laporan);
                $akhirInput = $this->convertBulanKeInggris($request->akhir_laporan);
    
                $awalLaporan = Carbon::createFromFormat('d F Y', $awalInput)->startOfDay();
                $akhirLaporan = Carbon::createFromFormat('d F Y', $akhirInput)->endOfDay();
    
                $query->whereBetween('created_at', [$awalLaporan, $akhirLaporan]);
            } catch (\Exception $e) {
                return back()->with('error', 'Format tanggal tidak valid.');
            }
        }
    
        $pesanans = $query->get();
    
        $pdf = PDF::loadView('print.laporan', compact('pesanans', 'awalLaporan', 'akhirLaporan'));
        return $pdf->stream('laporan_pesanan.pdf');
    }

    public function show($id)
    {
        $pesanan = Pesanan::with(['user', 'items.barang', 'pembayaran'])->findOrFail($id);
        return view('admin.laporan.show', compact('pesanan'));
    }

        
}

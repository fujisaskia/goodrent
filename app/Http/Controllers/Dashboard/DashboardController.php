<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function dashboard()
    {
        // Menghitung jumlah pemesanan yang berhasil
        $jumlahPemesanan = $this->countSuccessfulOrders();

        // Menghitung jumlah user dengan role Pelanggan
        $jumlahPelanggan = $this->countPelanggan();

        // Menghitung pendapatan bulan ini (misalnya bulan April 2025)
        $pendapatanBulanIni = $this->monthlyRevenue(4, 2025);

        return view('admin.dashboard', compact('jumlahPemesanan', 'jumlahPelanggan', 'pendapatanBulanIni'));
    }

    public function getMonthlyRevenueData($year)
    {
        $pendapatanPerBulan = [];
        $labels = [];

        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::createFromDate($year, $month, 1);

            $pendapatanBulanan = DB::table('pembayarans')
                ->where('status_pembayaran', 'Berhasil')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('total_bayar');

            $pendapatanPerBulan[] = $pendapatanBulanan / 1000; // ribuan
            $labels[] = $date->translatedFormat('M Y');
        }

        return response()->json([
            'labels' => $labels,
            'data' => $pendapatanPerBulan,
        ]);
    }

    public function getMonthlyData($year)
    {
        $pemesananPerBulan = [];
        $labels = [];

        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::createFromDate($year, $month, 1);

            $jumlahUser = DB::table('pembayarans')
                ->where('status_pembayaran', 'Berhasil')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->distinct('pesanan_id')
                ->count('pesanan_id');

            $pemesananPerBulan[] = $jumlahUser;
            $labels[] = $date->translatedFormat('M Y');
        }

        return response()->json([
            'labels' => $labels,
            'data' => $pemesananPerBulan,
        ]);
    }

    public function getAvailableYears()
    {
        $years = DB::table('pembayarans')
            ->selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'asc')
            ->pluck('year');

        return response()->json($years);
    }

    // Fungsi untuk mendapatkan label bulan
    // private function getLast12MonthsLabels()
    // {
    //     $labels = [];
    //     $currentMonth = now()->month;
    //     $currentYear = now()->year;

    //     // Loop untuk mengambil label bulan
    //     for ($i = 11; $i >= 0; $i--) {
    //         $month = $currentMonth - $i;
    //         $year = $currentYear;

    //         // Jika bulan kurang dari 1, kurangi tahun dan atur bulan ke 12
    //         if ($month < 1) {
    //             $month += 12;
    //             $year--;
    //         }

    //         // Format nama bulan
    //         $labels[] = now()->setMonth($month)->format('M Y');
    //     }

    //     return array_reverse($labels); // Balikan dengan urutan bulan yang benar
    // }

    public function countSuccessfulOrders()
    {
        // Hitung jumlah pesanan dengan status pembayaran berhasil
        $jumlahPemesanan = DB::table('pesanans')
            ->join('pembayarans', 'pesanans.id', '=', 'pembayarans.pesanan_id')
            ->where('pembayarans.status_pembayaran', 'Berhasil')
            ->count();

        return $jumlahPemesanan;
    }

    public function countPelanggan()
    {
        // Menghitung jumlah user dengan role selain admin dan superadmin
        $jumlahPelanggan = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['admin', 'superadmin']);
        })->count();

        return $jumlahPelanggan;
    }

    public function monthlyRevenue($month, $year)
    {
        // Hitung jumlah pendapatan bulanan dari pembayaran yang status 'Berhasil'
        $pendapatanBulanan = DB::table('pembayarans')
            ->where('status_pembayaran', 'Berhasil')
            ->whereMonth('created_at', $month) // Ganti dengan 'created_at'
            ->whereYear('created_at', $year)   // Ganti dengan 'created_at'
            ->sum('total_bayar');         // Jumlahkan kolom 'jumlah_pembayaran'

        return $pendapatanBulanan;
    }
}

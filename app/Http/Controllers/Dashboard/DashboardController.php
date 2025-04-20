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

    public function getMonthlyRevenueData()
    {
        $currentYear = now()->year;
        $pendapatanPerBulan = [];
        $labels = [];

        for ($month = 1; $month <= 12; $month++) {
            // Buat objek tanggal berdasarkan bulan
            $date = Carbon::createFromDate($currentYear, $month, 1);

            // Hitung pendapatan hanya bulan itu
            $pendapatanBulanan = DB::table('pembayarans')
                ->where('status_pembayaran', 'Berhasil')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $currentYear)
                ->sum('total_bayar');

            // Tambahkan ke array
            $pendapatanPerBulan[] = $pendapatanBulanan / 1000; // Dalam ribuan
            $labels[] = $date->translatedFormat('F Y'); // Contoh: Januari, Februari
        }

        return response()->json([
            'labels' => $labels,
            'data' => $pendapatanPerBulan,
        ]);
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

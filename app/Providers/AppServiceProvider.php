<?php

namespace App\Providers;

use App\Models\Pesanan;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.custom');

        View::composer('*', function ($view) {
            $jumlahNotifikasi = Pesanan::count();

            $notifikasi = Pesanan::with(['user', 'items.barang', 'pembayaran'])
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();

            foreach ($notifikasi as $notif) {
                if ($notif->tanggal_mulai && $notif->tanggal_selesai) {
                    $notif->durasi_sewa = $notif->tanggal_selesai->diffInHours($notif->tanggal_mulai);
                } else {
                    $notif->durasi_sewa = 0; // atau null, tergantung kebutuhanmu
                }
            }

            $view->with(compact('jumlahNotifikasi', 'notifikasi'));
        });
    }
}

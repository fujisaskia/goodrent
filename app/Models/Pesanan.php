<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'user_id',
        'barang_id',
        'tanggal_pesan',
        'durasi_sewa',
        'metode_pembayaran',
        'harga_ps',
        'diskon_id',
        'potongan_harga',
        'total_bayar',
        'status_pemesanan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function diskon()
    {
        return $this->belongsTo(Diskon::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}
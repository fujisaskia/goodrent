<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'user_id',
        'diskon_id',
        'potongan_harga',
        'total_bayar',
        'status_pemesanan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(PesananItem::class);
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
        return $this->hasOne(Pembayaran::class, 'pesanan_id')->latestOfMany();
    }
    

    public function keranjangItems()
    {
        return $this->hasMany(KeranjangItem::class);
    }
}

// public function riwayatPesanan()
// {
//     return $this->hasOne(RiwayatPesanan::class);
// }
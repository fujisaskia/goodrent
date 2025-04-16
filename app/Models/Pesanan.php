<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = ['user_id', 'barang_id', 'durasi_sewa', 'tanggal_mulai', 'tanggal_selesai'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function keranjangItem()
    {
        return $this->hasOne(KeranjangItem::class);
    }

    public function riwayatPesanan()
    {
        return $this->hasOne(RiwayatPesanan::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeranjangItem extends Model
{
    protected $fillable = ['keranjang_id', 'pesanan_id', 'durasi_jam', 'harga'];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class);
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}

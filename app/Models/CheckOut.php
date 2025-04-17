<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    protected $fillable = ['keranjang_id', 'diskon_id', 'potongan_harga', 'total_bayar', 'metode_pembayaran'];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class);
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

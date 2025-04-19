<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'pesanan_id',
        'total_bayar',
        'nomor_pembayaran',
        'tanggal_bayar',
        'metode_pembayaran',
        'status_pembayaran'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}


// public function checkout()
// {
//     return $this->belongsTo(CheckOut::class, 'check_out_id');
// }

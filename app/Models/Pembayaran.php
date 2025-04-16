<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['check_out_id', 'metode_pembayaran', 'jumlah_bayar', 'status_pembayaran'];

    public function checkout()
    {
        return $this->belongsTo(CheckOut::class, 'check_out_id');
    }
}

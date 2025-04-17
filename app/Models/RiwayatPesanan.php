<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPesanan extends Model
{
    protected $fillable = ['user_id', 'pesanan_id', 'status_pemesanan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}

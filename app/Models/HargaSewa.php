<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaSewa extends Model
{
    protected $fillable = ['barang_id', 'durasi_jam', 'harga'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}

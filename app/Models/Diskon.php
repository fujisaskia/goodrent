<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $fillable = [
        'nama_diskon',
        'kode_diskon',
        'jenis_diskon',
        'besar_diskon',
        'masa_berlaku',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}

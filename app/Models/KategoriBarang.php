<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    protected $fillable = ['nama', 'status'];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}

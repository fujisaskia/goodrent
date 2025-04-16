<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriDiskon extends Model
{
    protected $fillable = ['nama', 'status'];

    public function diskons()
    {
        return $this->hasMany(Diskon::class);
    }
}

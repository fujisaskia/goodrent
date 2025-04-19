<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $table = 'diskons';

    protected $fillable = [
        'nama_diskon',
        'kode_diskon',
        'kategori_diskon_id',
        'besar_diskon',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    // Relasi ke kategori_diskons
    public function kategori()
    {
        return $this->belongsTo(KategoriDiskon::class, 'kategori_diskon_id');
    }

    // Generate kode diskon otomatis
    public static function generateKodeDiskon($kategoriDiskon)
    {
        $slugKategori = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $kategoriDiskon));
        $angkaRandom = rand(1000, 9999);
        return $slugKategori . $angkaRandom;
    }

    // Cek apakah diskon masih berlaku
    public function isValid()
    {
        return now()->between($this->tanggal_mulai, $this->tanggal_selesai);
    }
}


    // public function checkouts()
    // {
    //     return $this->hasMany(CheckOut::class);
    // }

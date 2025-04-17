<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $fillable = ['nama_diskon', 'kode_diskon', 'kategori_diskon_id', 'besar_diskon', 'tanggal_mulai', 'tanggal_selesai'];

    public function kategori()
    {
        return $this->belongsTo(KategoriDiskon::class, 'kategori_diskon_id');
    }

    public function checkouts()
    {
        return $this->hasMany(CheckOut::class);
    }

    public static function generateKodeDiskon($kategoriDiskon)
    {
        // Bersihkan kategori: huruf besar, tanpa spasi/karakter aneh
        $slugKategori = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $kategoriDiskon));

        // Tambahkan angka random 4 digit
        $angkaRandom = rand(1000, 9999);

        // Gabungkan tanpa tanda strip
        return $slugKategori . $angkaRandom;
    }

    public function isValid()
    {
        return now()->between($this->tanggal_mulai, $this->tanggal_selesai);
    }
}

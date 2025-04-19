<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['kode_barang', 'nama_barang', 'kategori_barang_id', 'deskripsi', 'image', 'stok', 'status_barang'];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_barang_id');
    }

    public function hargaSewas()
    {
        return $this->hasMany(HargaSewa::class);
    }

    public function hargaUtama()
    {
        return $this->hasOne(HargaSewa::class)->where('durasi_jam', 24);
    }

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }

    public function pesananItems()
    {
        return $this->hasMany(PesananItem::class);
    }

    // Di model Barang
    public function keranjangItems()
    {
        return $this->hasMany(KeranjangItem::class);
    }



    public static function generateKodeBarang($kategoriBarangId)
    {
        // Ambil nama kategori berdasarkan ID
        $kategori = \App\Models\KategoriBarang::find($kategoriBarangId);

        if (!$kategori) {
            throw new \Exception("Kategori tidak ditemukan.");
        }

        // Ambil nama kategori dan pastikan semuanya besar
        $kategoriNama = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $kategori->nama)); // Menghilangkan karakter non-alfanumerik

        // Ambil 2 karakter pertama dan karakter ketiga dari nama kategori untuk membuat prefix
        $prefix = substr($kategoriNama, 0, 1); // Ambil karakter pertama, contoh: 'P' dari 'PS5'
        $numberPart = substr($kategoriNama, 2, 1); // Ambil karakter ketiga, contoh: '5' dari 'PS5'

        // Gabungkan prefix dan angka yang diambil dari karakter ketiga
        $prefix .= $numberPart; // Hasilnya jadi 'P5'

        // Cari kode barang terakhir yang cocok dengan prefix
        $lastBarang = self::where('kode_barang', 'like', "{$prefix}%")
            ->orderBy('kode_barang', 'desc')
            ->first();

        if ($lastBarang) {
            $lastNumber = (int) substr($lastBarang->kode_barang, strlen($prefix));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Menghasilkan kode barang baru dengan prefix dan nomor yang telah dihitung
        return $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}
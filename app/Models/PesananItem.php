<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id',
        'barang_id',
        'durasi_sewa',
        'tanggal_mulai',
        'tanggal_selesai',
        'harga_barang',
        'subtotal',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}

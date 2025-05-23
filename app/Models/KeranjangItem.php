<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeranjangItem extends Model
{
    protected $table = 'keranjang_items';

    protected $fillable = [
        'keranjang_id',
        'barang_id',
        'durasi_sewa',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
    
}

<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barang::create([
            'nama_barang' => 'Contoh Barang',
            'kode_barang' => 'BRG001',
            'kategori_barang_id' => 1,
            'deskripsi' => 'Deskripsi contoh barang',
            'image' => 'Dummy.png',
            // 'harga' => 100000,
            'stok' => 10,
            'status_barang' => 'Tersedia',
        ]);
    }
}

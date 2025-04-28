<?php

namespace Database\Seeders;

use App\Models\KategoriBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriBarangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriBarang::create([
            'nama' => 'Contoh Kategori',
            'status' => 'Draft',
        ]);
    }
}

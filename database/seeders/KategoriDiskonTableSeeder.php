<?php

namespace Database\Seeders;

use App\Models\KategoriDiskon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriDiskonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriDiskon::create([
            'nama' => 'Contoh Kategori Diskon',
            'status' => 'Draft',
        ]);
    }
}

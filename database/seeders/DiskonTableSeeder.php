<?php

namespace Database\Seeders;

use App\Models\Diskon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiskonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Diskon::create([
            'nama_diskon' => 'Contoh Diskon',
            'kode_diskon' => 'DSK001',
            'kategori_diskon_id' => 1,
            'besar_diskon' => 10,
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addDays(7),
        ]);
    }
}

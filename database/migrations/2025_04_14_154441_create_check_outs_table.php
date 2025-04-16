<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('check_outs', function (Blueprint $table) {
            $table->id();
            // Relasi ke keranjang (karena checkout berdasarkan isi keranjang)
            $table->foreignId('keranjang_id')->constrained('keranjangs')->onDelete('cascade');
            // Relasi ke diskon (jika ada)
            $table->foreignId('diskon_id')->nullable()->constrained('diskons')->onDelete('set null');
            // Rincian checkout
            $table->decimal('potongan_harga', 15, 2)->default(0);
            $table->decimal('total_bayar', 15, 2);
            $table->string('metode_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_outs');
    }
};

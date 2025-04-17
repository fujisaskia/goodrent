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
        Schema::create('riwayat_pesanans', function (Blueprint $table) {
            $table->id();
            // Relasi ke user dan pesanan
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
            $table->enum('status_pemesanan', ['Dalam Penyewaan', 'Selesai', 'Dibatalkan'])->default('Dalam Penyewaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pesanans');
    }
};

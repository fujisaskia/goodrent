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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            // Relasi ke checkout karena pembayaran berdasarkan checkout
            $table->foreignId('check_out_id')->constrained('check_outs')->onDelete('cascade');

            $table->enum('metode_pembayaran', ['Digital', 'Non-Digital']);
            $table->decimal('jumlah_bayar', 15, 2);

            $table->enum('status_pembayaran', ['Menunggu', 'Berhasil', 'Gagal'])->default('Menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};

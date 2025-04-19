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
            // Relasi ke pesanan
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');

            $table->decimal('total_bayar', 15, 2);

            $table->string('nomor_pembayaran')->unique(); // bisa nomor transaksi atau kode bayar
            $table->dateTime('tanggal_bayar')->nullable(); // bisa diisi saat pembayaran berhasil
            
            $table->enum('metode_pembayaran', ['Tunal', 'Digital']);

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

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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            $table->date('tanggal_pesan');
            $table->integer('durasi_sewa');
            $table->string('metode_pembayaran');
            $table->decimal('harga_ps');
            $table->foreignId('diskon_id')->constrained('diskons')->onDelete('cascade');
            $table->decimal('potongan_harga');
            $table->decimal('total_bayar');
            $table->enum('status_pemesanan', ['Dalam Penyewaan', 'Selesai', 'Dibatalkan'])->default('Dalam Penyewaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};

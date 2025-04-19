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
            $table->foreignId('diskon_id')->nullable()->constrained('diskons')->onDelete('set null');
            $table->decimal('potongan_harga', 15, 2)->default(0);
            $table->decimal('total_bayar', 10, 2);
            $table->enum('status_pemesanan', ['Menunggu', 'Dalam Penyewaan', 'Selesai', 'Dibatalkan'])->default('Menunggu');
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

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
        Schema::create('keranjang_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keranjang_id')->constrained('keranjangs')->onDelete('cascade');
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade'); // ambil dari pesanan
            $table->integer('durasi_jam');
            $table->decimal('harga', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang_items');
    }
};

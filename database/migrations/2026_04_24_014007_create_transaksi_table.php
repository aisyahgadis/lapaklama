<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('transaksi_id');
            $table->unsignedBigInteger('pembeli_id');
            $table->unsignedBigInteger('baju_id');
            $table->decimal('total_harga', 15, 2);
            $table->text('catatan_custom')->nullable(); // catatan custom order dari pembeli
            $table->enum('status', ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('pending');
            $table->timestamps();

            $table->foreign('pembeli_id')->references('pembeli_id')->on('pembeli')->onDelete('cascade');
            $table->foreign('baju_id')->references('baju_id')->on('baju')->onDelete('cascade');
        });
    }

    public function down(): void { Schema::dropIfExists('transaksi'); }
};
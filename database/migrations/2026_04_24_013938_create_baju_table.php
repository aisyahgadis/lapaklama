<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('baju', function (Blueprint $table) {
            $table->id('baju_id');
            $table->unsignedBigInteger('penjual_id');
            $table->unsignedBigInteger('penjahit_id')->nullable(); // boleh null dulu, dipilih admin/nanti
            $table->string('nama_baju');
            $table->text('deskripsi')->nullable();     // deskripsi kondisi barang bekas
            $table->decimal('harga', 15, 2);
            $table->enum('kondisi', ['baru', 'bekas_bagus', 'bekas_layak'])->default('bekas_bagus');
            $table->enum('status_listing', ['tersedia', 'dipesan', 'selesai'])->default('tersedia');
            $table->timestamps();

            $table->foreign('penjual_id')->references('penjual_id')->on('penjual')->onDelete('cascade');
            $table->foreign('penjahit_id')->references('penjahit_id')->on('penjahit')->onDelete('set null');
        });
    }

    public function down(): void { Schema::dropIfExists('baju'); }
};
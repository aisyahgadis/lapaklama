<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penjahit', function (Blueprint $table) {
            $table->id('penjahit_id');
            $table->string('nama');
            $table->string('lokasi');
            $table->float('rating')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('penjahit'); }
};
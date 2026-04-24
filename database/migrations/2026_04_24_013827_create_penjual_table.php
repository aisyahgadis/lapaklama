<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penjual', function (Blueprint $table) {
            $table->id('penjual_id');
            $table->unsignedBigInteger('user_id')->unique(); // 1 user = 1 penjual
            $table->string('nama_toko');
            $table->float('rating')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void { Schema::dropIfExists('penjual'); }
};
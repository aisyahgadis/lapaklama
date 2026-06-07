<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pembeli', function (Blueprint $table) {
            $table->id('pembeli_id');
            $table->unsignedBigInteger('user_id')->unique(); // 1 user = 1 pembeli
            $table->text('alamat_default')->nullable();
            $table->integer('total_beli')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void { Schema::dropIfExists('pembeli'); }
};
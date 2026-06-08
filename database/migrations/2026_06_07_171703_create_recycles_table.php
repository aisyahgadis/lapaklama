<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recycles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();          // pengaju
            $table->foreignId('penjahit_id')->nullable()->constrained('users')->nullOnDelete(); // diisi saat admin assign
            $table->string('gambar');
            $table->text('deskripsi');
            $table->unsignedBigInteger('harga')->nullable(); // diisi penjahit setelah diskusi WA
            $table->enum('status', [
                'menunggu_assign',
                'assigned',
                'dikerjakan',
                'dikirim',
                'selesai',
            ])->default('menunggu_assign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recycles');
    }
};

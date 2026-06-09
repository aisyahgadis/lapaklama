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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('nama_penerima')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->string('resi')->nullable();
            $table->integer('rating')->nullable();
            $table->text('review')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'nama_penerima',
                'no_telp',
                'metode_pembayaran',
                'bukti_bayar',
                'resi',
                'rating',
                'review'
            ]);
        });
    }
};

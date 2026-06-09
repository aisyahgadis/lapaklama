<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('recycles', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('deskripsi');
            $table->text('alamat_pengiriman')->nullable()->after('harga');
            $table->string('kode_resi')->nullable()->after('alamat_pengiriman');
        });
    }

    public function down()
    {
        Schema::table('recycles', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'alamat_pengiriman', 'kode_resi']);
        });
    }
};

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $budi = User::where('email', 'budi@lapaklama.com')->first();
 
        // Produk milik Budi
        Product::create([
            'user_id'   => $budi->id,
            'gambar'    => 'produk/kemeja-budi.jpg',
            'harga'     => 45000,
            'status'    => 'tersedia',
            'deskripsi' => 'Kemeja flanel bekas pemakaian 2x, kondisi sangat baik, ukuran M.',
        ]);
        Product::create([
            'user_id'   => $budi->id,
            'gambar'    => 'produk/jaket-budi.jpg',
            'harga'     => 85000,
            'status'    => 'tersedia',
            'deskripsi' => 'Jaket denim second, warna biru tua, ukuran L. Tanpa cacat.',
        ]);
        Product::create([
            'user_id'   => $budi->id,
            'gambar'    => 'produk/kaos-budi.jpg',
            'harga'     => 25000,
            'status'    => 'terjual',
            'deskripsi' => 'Kaos polos putih, ukuran S. Sudah dicuci bersih.',
        ]);

    }
}
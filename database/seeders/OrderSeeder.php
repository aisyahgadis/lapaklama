<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $andi  = User::where('email', 'andi@lapaklama.com')->first();
        $rina  = User::where('email', 'rina@lapaklama.com')->first();
        $fajar = User::where('email', 'fajar@lapaklama.com')->first();
 
        // Ambil produk yang statusnya terjual atau tersedia
        $kaos   = Product::where('deskripsi', 'like', '%Kaos polos%')->first();
        $kemeja = Product::where('deskripsi', 'like', '%Kemeja flanel%')->first();
        $dress  = Product::where('deskripsi', 'like', '%Dress batik%')->first();
 
        // Order selesai (kaos sudah terjual)
        Order::create([
            'user_id'    => $fajar->id,
            'product_id' => $kaos->id,
            'alamat'     => 'Jl. Mawar No. 12, Surabaya, Jawa Timur',
            'status'     => 'selesai',
        ]);
 
        // Order sedang diproses
        Order::create([
            'user_id'    => $andi->id,
            'product_id' => $kemeja->id,
            'alamat'     => 'Jl. Melati No. 5, Malang, Jawa Timur',
            'status'     => 'diproses',
        ]);
 
        // Order baru masuk (menunggu)
        Order::create([
            'user_id'    => $rina->id,
            'product_id' => $dress->id,
            'alamat'     => 'Jl. Kenanga No. 8, Sidoarjo, Jawa Timur',
            'status'     => 'menunggu',
        ]);
    }
}
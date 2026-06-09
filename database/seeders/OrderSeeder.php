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
 
        // Ambil produk yang statusnya terjual atau tersedia
        $kaos   = Product::where('deskripsi', 'like', '%Kaos polos%')->first();
        $kemeja = Product::where('deskripsi', 'like', '%Kemeja flanel%')->first();
        $dress  = Product::where('deskripsi', 'like', '%Dress batik%')->first();
 
        // Order sedang diproses
        Order::create([
            'user_id'    => $andi->id,
            'product_id' => $kemeja->id,
            'alamat'     => 'Jl. Melati No. 5, Malang, Jawa Timur',
            'status'     => 'diproses',
        ]);
 
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Recycle;

class RecycleSeeder extends Seeder
{
    public function run(): void
    {
        $andi    = User::where('email', 'andi@lapaklama.com')->first();
        $rina    = User::where('email', 'rina@lapaklama.com')->first();
        $fajar   = User::where('email', 'fajar@lapaklama.com')->first();
        $hendra  = User::where('email', 'hendra@lapaklama.com')->first();
        $dewi    = User::where('email', 'dewi@lapaklama.com')->first();
 
        // Request belum di-assign admin
        Recycle::create([
            'user_id'     => $fajar->id,
            'penjahit_id' => null,
            'gambar'      => 'recycle/celana-fajar.jpg',
            'deskripsi'   => 'Celana jeans lama ingin dijadikan tas selempang.',
            'harga'       => null,
            'status'      => 'menunggu_assign',
        ]);
 
        // Sudah di-assign, menunggu penjahit kerjakan
        Recycle::create([
            'user_id'     => $rina->id,
            'penjahit_id' => $dewi->id,
            'gambar'      => 'recycle/kemeja-rina.jpg',
            'deskripsi'   => 'Kemeja oversized ingin dipendekkan jadi crop top.',
            'harga'       => 35000,
            'status'      => 'assigned',
        ]);
 
        // Sedang dikerjakan penjahit
        Recycle::create([
            'user_id'     => $andi->id,
            'penjahit_id' => $hendra->id,
            'gambar'      => 'recycle/jaket-andi.jpg',
            'deskripsi'   => 'Jaket parasut ingin diubah jadi rompi.',
            'harga'       => 50000,
            'status'      => 'dikerjakan',
        ]);
 
        // Sudah selesai dan dikirim balik ke user
        Recycle::create([
            'user_id'     => $rina->id,
            'penjahit_id' => $hendra->id,
            'gambar'      => 'recycle/dress-rina.jpg',
            'deskripsi'   => 'Dress panjang ingin diperpendek jadi midi dress.',
            'harga'       => 40000,
            'status'      => 'selesai',
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Recycle;

class RecycleSeeder extends Seeder
{
    public function run(): void
    {
        $andi    = User::where('email', 'andi@lapaklama.com')->first();
        $hendra  = User::where('email', 'hendra@lapaklama.com')->first();
 
        // Sedang dikerjakan penjahit
        Recycle::create([
            'user_id'     => $andi->id,
            'penjahit_id' => $hendra->id,
            'gambar'      => 'recycle/jaket-andi.jpg',
            'deskripsi'   => 'Jaket parasut ingin diubah jadi rompi.',
            'harga'       => 50000,
            'status'      => 'dikerjakan',
        ]);
 
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'nama'     => 'Admin LapaKlama',
            'email'    => 'lapaklama@lapaklama.com',
            'password' => bcrypt('admin123'),
            'jenis'    => 'admin',
        ]);
 
        // Penjual
        User::create([
            'nama'        => 'Budi Santoso',
            'nama_toko'   => 'Toko Budi',
            'no_hp'       => '081234567890',
            'alamat_toko' => 'Jl. Mawar No. 123',
            'email'       => 'budi@lapaklama.com',
            'password'    => bcrypt('penjual123'),
            'jenis'       => 'penjual',
        ]);

        // Penjahit
        User::create([
            'nama'     => 'Hendra Wijaya',
            'email'    => 'hendra@lapaklama.com',
            'password' => bcrypt('penjahit123'),
            'jenis'    => 'penjahit',
        ]);

        // Pembeli
        User::create([
            'nama'     => 'Andi Pratama',
            'email'    => 'andi@lapaklama.com',
            'password' => bcrypt('user123'),
            'jenis'    => 'pembeli',
        ]);
    }
}

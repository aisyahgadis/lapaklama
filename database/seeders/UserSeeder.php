<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'nama'     => 'Admin LapaKlama',
            'email'    => 'admin@lapaklama.com',
            'password' => bcrypt('admin123'),
            'jenis'    => 'admin',
        ]);
 
        // Penjual
        User::create([
            'nama'     => 'Budi Santoso',
            'email'    => 'budi@lapaklama.com',
            'password' => bcrypt('penjual123'),
            'jenis'    => 'penjual',
        ]);
        User::create([
            'nama'     => 'Siti Rahayu',
            'email'    => 'siti@lapaklama.com',
            'password' => bcrypt('penjual123'),
            'jenis'    => 'penjual',
        ]);

        // Penjahit
        User::create([
            'nama'     => 'Hendra Wijaya',
            'email'    => 'hendra@lapaklama.com',
            'password' => bcrypt('penjahit123'),
            'jenis'    => 'penjahit',
        ]);
        User::create([
            'nama'     => 'Dewi Kusuma',
            'email'    => 'dewi@lapaklama.com',
            'password' => bcrypt('penjahit123'),
            'jenis'    => 'penjahit',
        ]);

        // User biasa
        User::create([
            'nama'     => 'Andi Pratama',
            'email'    => 'andi@lapaklama.com',
            'password' => bcrypt('user123'),
            'jenis'    => 'user',
        ]);
        User::create([
            'nama'     => 'Rina Putri',
            'email'    => 'rina@lapaklama.com',
            'password' => bcrypt('user123'),
            'jenis'    => 'user',
        ]);
        User::create([
            'nama'     => 'Fajar Nugroho',
            'email'    => 'fajar@lapaklama.com',
            'password' => bcrypt('user123'),
            'jenis'    => 'user',
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Tambahkan kolom-kolom ini agar bisa diisi
    protected $fillable = [
        'user_id',
        'gambar',
        'harga',
        'status',
        'deskripsi'
    ];

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
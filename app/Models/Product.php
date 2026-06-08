<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'gambar',
        'harga',
        'kategori',
        'status',
        'deskripsi',
    ];

    // -------------------------------------------------------
    // Relasi
    // -------------------------------------------------------

    // Relasi ke tabel User bawaan
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Alias untuk relasi user (Penjual yang memiliki produk ini)
    public function penjual()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Order yang mengandung produk ini
    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id');
    }

    // -------------------------------------------------------
    // Helper
    // -------------------------------------------------------

    public function isTersedia(): bool 
    { 
        return $this->status === 'tersedia'; 
    }
    
    public function isTerjual(): bool  
    { 
        return $this->status === 'terjual'; 
    }
}
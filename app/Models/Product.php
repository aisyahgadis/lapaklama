<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'gambar',
        'harga',
        'status',
        'deskripsi',
    ];

    // -------------------------------------------------------
    // Relasi
    // -------------------------------------------------------

    // Penjual yang memiliki produk ini
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

    public function isTersedia(): bool { return $this->status === 'tersedia'; }
    public function isTerjual(): bool  { return $this->status === 'terjual'; }
}
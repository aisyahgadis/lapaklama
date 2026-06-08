<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
<<<<<<< HEAD
    use HasFactory;

    // Tambahkan kolom-kolom ini agar bisa diisi
=======
>>>>>>> fed6c30316838426f2575f2ce8ef0e50f03d55aa
    protected $fillable = [
        'user_id',
        'gambar',
        'harga',
        'status',
<<<<<<< HEAD
        'deskripsi'
    ];

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
=======
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
>>>>>>> fed6c30316838426f2575f2ce8ef0e50f03d55aa
}
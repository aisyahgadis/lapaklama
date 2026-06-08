<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'alamat',
        'status',
        'nama_penerima',
        'no_telp',
        'metode_pembayaran',
        'bukti_bayar',
        'resi',
        'rating',
        'review',
    ];

    // -------------------------------------------------------
    // Relasi
    // -------------------------------------------------------

    // User yang membeli
    public function pembeli()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Produk yang dibeli
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Penjual produk ini (lewat product)
    public function penjual()
    {
        return $this->hasOneThrough(
            User::class,
            Product::class,
            'id',        // FK di products
            'id',        // FK di users
            'product_id', // FK lokal di orders
            'user_id'    // FK lokal di products
        );
    }

    // -------------------------------------------------------
    // Helper
    // -------------------------------------------------------

    public function isMenunggu(): bool  { return $this->status === 'menunggu'; }
    public function isDiproses(): bool  { return $this->status === 'diproses'; }
    public function isDikirim(): bool   { return $this->status === 'dikirim'; }
    public function isSelesai(): bool   { return $this->status === 'selesai'; }

    // Ongkir flat sesuai kesepakatan bisnis
    public const ONGKIR = 15000;
}
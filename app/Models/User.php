<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'jenis', // admin | penjual | penjahit | pembeli
        'status_penjual', // tidak_ada | pending | approved
        'nama_toko',
        'no_hp',
        'alamat_toko',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // -------------------------------------------------------
    // Relasi
    // -------------------------------------------------------

    // Produk yang dijual (jika user adalah penjual)
    public function products()
    {
        return $this->hasMany(Product::class, 'user_id');
    }

    // Pembelian yang dilakukan (jika user adalah pembeli)
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    // Request daur ulang yang diajukan (jika user adalah pembeli)
    public function recycles()
    {
        return $this->hasMany(Recycle::class, 'user_id');
    }

    // Request daur ulang yang dikerjakan (jika user adalah penjahit)
    public function recyclesAsPenjahit()
    {
        return $this->hasMany(Recycle::class, 'penjahit_id');
    }

    // -------------------------------------------------------
    // Helper cek jenis
    // -------------------------------------------------------

    public function isAdmin(): bool    { return $this->jenis === 'admin'; }
    public function isPenjual(): bool  { return $this->jenis === 'penjual'; }
    public function isApprovedPenjual(): bool { return $this->jenis === 'penjual' && $this->status_penjual === 'approved'; }
    public function isPenjahit(): bool { return $this->jenis === 'penjahit'; }
    public function isPembeli(): bool  { return $this->jenis === 'pembeli'; }
}
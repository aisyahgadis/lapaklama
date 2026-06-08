<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recycle extends Model
{
    protected $fillable = [
        'user_id',
        'penjahit_id',
        'gambar',
        'deskripsi',
        'harga',
        'status',
    ];

    // -------------------------------------------------------
    // Relasi
    // -------------------------------------------------------

    // User yang mengajukan request
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Penjahit yang ditugaskan (nullable, diisi saat admin assign)
    public function penjahit()
    {
        return $this->belongsTo(User::class, 'penjahit_id');
    }

    // -------------------------------------------------------
    // Helper cek status
    // -------------------------------------------------------

    public function isMenungguAssign(): bool { return $this->status === 'menunggu_assign'; }
    public function isAssigned(): bool       { return $this->status === 'assigned'; }
    public function isDikerjakan(): bool     { return $this->status === 'dikerjakan'; }
    public function isDikirim(): bool        { return $this->status === 'dikirim'; }
    public function isSelesai(): bool        { return $this->status === 'selesai'; }

    // Sudah ada penjahit yang di-assign
    public function sudahDiassign(): bool    { return !is_null($this->penjahit_id); }

    // Sudah ada harga dari penjahit
    public function sudahAdaHarga(): bool    { return !is_null($this->harga); }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baju extends Model
{
    protected $table = 'baju';
    protected $primaryKey = 'baju_id';
    protected $fillable = ['penjual_id', 'penjahit_id', 'nama_baju', 'deskripsi', 'harga', 'kondisi', 'status_listing'];

    public function penjual()
    {
        return $this->belongsTo(Penjual::class, 'penjual_id', 'penjual_id');
    }

    public function penjahit()
    {
        return $this->belongsTo(Penjahit::class, 'penjahit_id', 'penjahit_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'baju_id', 'baju_id');
    }
}
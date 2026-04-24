<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'transaksi_id';
    protected $fillable = ['pembeli_id', 'baju_id', 'total_harga', 'catatan_custom', 'status'];

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'pembeli_id', 'pembeli_id');
    }

    public function baju()
    {
        return $this->belongsTo(Baju::class, 'baju_id', 'baju_id');
    }
}
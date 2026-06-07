<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjahit extends Model
{
    protected $table = 'penjahit';
    protected $primaryKey = 'penjahit_id';
    protected $fillable = ['nama', 'lokasi', 'rating'];

    public function baju()
    {
        return $this->hasMany(Baju::class, 'penjahit_id', 'penjahit_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjual extends Model
{
    protected $table = 'penjual';
    protected $primaryKey = 'penjual_id';
    protected $fillable = ['user_id', 'nama_toko', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function baju()
    {
        return $this->hasMany(Baju::class, 'penjual_id', 'penjual_id');
    }
}
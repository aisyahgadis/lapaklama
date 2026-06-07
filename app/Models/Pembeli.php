<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    protected $table = 'pembeli';
    protected $primaryKey = 'pembeli_id';
    protected $fillable = ['user_id', 'alamat_default', 'total_beli'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'pembeli_id', 'pembeli_id');
    }
}
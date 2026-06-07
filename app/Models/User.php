<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';
    protected $fillable = ['nama', 'email', 'password', 'role'];
    protected $hidden = ['password', 'remember_token'];

    public function pembeli()
    {
        return $this->hasOne(Pembeli::class, 'user_id', 'user_id');
    }

    public function penjual()
    {
        return $this->hasOne(Penjual::class, 'user_id', 'user_id');
    }

    // Helper: cek role
    public function isPembeli(): bool { return $this->role === 'pembeli'; }
    public function isPenjual(): bool { return $this->role === 'penjual'; }
    public function isAdmin(): bool   { return $this->role === 'admin'; }
}
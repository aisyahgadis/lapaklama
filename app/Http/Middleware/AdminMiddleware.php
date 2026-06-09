<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user login dan jenisnya admin
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        // Jika bukan admin, redirect ke halaman login dengan pesan error
        return redirect()->route('login')->withErrors(['message' => 'Anda tidak memiliki akses ke halaman ini.']);
    }
}

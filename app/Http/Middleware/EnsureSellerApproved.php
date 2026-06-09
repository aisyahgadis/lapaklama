<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureSellerApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isPenjual()) {
            if (!Auth::user()->isApprovedPenjual()) {
                return redirect()->route('user.home')->withErrors(['message' => 'Akun Penjual Anda sedang menunggu persetujuan Admin. Anda dialihkan ke halaman Pembeli untuk sementara.']);
            }
            return $next($request);
        }

        return redirect()->route('login')->withErrors(['message' => 'Anda tidak memiliki akses ke halaman ini.']);
    }
}

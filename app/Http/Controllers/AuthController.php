<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Method untuk menampilkan View form login
    public function showLoginForm()
    {
        // Ganti 'sesi.login' dengan nama file blade-mu (misal di dalam folder resources/views/sesi/login.blade.php)
        return view('sesi.index'); 
    }

    // Method untuk memproses login ke database
    public function login(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:pembeli,penjual'
        ], [
            'email.required' => 'Email wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.'
        ]);

        // 2. Siapkan data kredensial
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Cek apakah user mencentang "Ingat Saya"
        $remember = $request->has('remember');

        // 3. Lakukan percobaan login
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 4. Pengecekan Khusus Admin Lapaklama
            // Jika email adalah admin, langsung arahkan ke halaman admin tanpa mempedulikan role yang dipilih di form
            if ($user->email === 'lapaklama@lapaklama.com') {
                return redirect()->intended('/admin/dashboard'); // Sesuaikan dengan URL route admin kamu
            }

            // 5. Cek apakah role yang dipilih sesuai dengan role di database
            if ($user->role !== $request->role) {
                Auth::logout();
                return back()->withErrors([
                    'role' => 'Role tidak sesuai dengan akun Anda.',
                ])->onlyInput('email');
            }

            // 6. Arahkan berdasarkan role jika login sukses
            if ($user->role === 'pembeli') {
                // Gunakan nama route (rekomendasi) atau URL langsung
                return redirect()->route('user.home'); 
            } elseif ($user->role === 'penjual') {
                return redirect()->route('penjual.main');
            }
        }

        // 7. Jika gagal, kembalikan ke halaman login
        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan salah.',
        ])->onlyInput('email', 'role');
    }
}
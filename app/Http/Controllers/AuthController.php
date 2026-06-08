<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Method untuk menampilkan View form login
    public function showLoginForm()
    {
        return view('sesi.index'); 
    }

    // Method untuk memproses login ke database
    public function login(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'jenis' => 'required|in:pembeli,penjual'
        ], [
            'email.required' => 'Email wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.'
        ]);

        // 2. Siapkan data kredensial (hanya email dan password)
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
            if ($user->email === 'lapaklama@lapaklama.com' || $user->jenis === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            // 5. Cek apakah jenis yang dipilih sesuai dengan jenis di database
            if ($user->jenis !== $request->jenis) {
                Auth::logout();
                return back()->withErrors([
                    'message' => 'Jenis akun tidak sesuai dengan akun Anda.',
                ])->onlyInput('email');
            }

            // 6. Arahkan berdasarkan jenis jika login sukses
            if ($user->jenis === 'pembeli') {
                return redirect()->route('user.home'); 
            } elseif ($user->jenis === 'penjual') {
                return redirect()->route('main');
            }
        }

        // 7. Jika gagal, kembalikan ke halaman login
        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan salah.',
        ])->onlyInput('email', 'jenis');
    }
}
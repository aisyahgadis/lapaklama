<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'jenis'    => 'required|in:pembeli,penjual,admin',
        ], [
            'email.required'    => 'Email harus diisi',
            'email.email'       => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'jenis.required'    => 'Jenis akun harus dipilih',
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            $request->session()->regenerate();

            // Cek khusus admin
            if ($user->email === 'lapaklama@lapaklama.com' || $user->jenis === 'admin') {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil sebagai Admin',
                    'user' => $user,
                    'redirect_to' => '/admin/dashboard'
                ]);
            }

            // Cek apakah jenis yang dipilih di form sesuai dengan jenis di database
            if ($user->jenis !== $request->jenis) {
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Jenis akun tidak sesuai. Pastikan Anda memilih peran yang benar.'
                ], 401);
            }

            $request->session()->regenerate();

            // Tentukan redirect
            if ($user->jenis === 'pembeli') {
                $redirect = '/user/home';
                $message = 'Login berhasil sebagai Pembeli';
            } elseif ($user->jenis === 'penjual') {
                if ($user->status_penjual === 'pending') {
                    $redirect = '/user/home';
                    $message = 'Akun Penjual Anda masih dalam proses persetujuan oleh Admin.';
                } else {
                    $redirect = '/main';
                    $message = 'Login berhasil sebagai Penjual';
                }
            } elseif ($user->jenis === 'penjahit') {
                $redirect = '/penjahit/dashboard'; // Meski route dihapus tapi kita siapin
                $message = 'Login berhasil sebagai Penjahit';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'user' => $user,
                'redirect_to' => $redirect
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Login Gagal, pastikan email dan password yang Anda masukkan benar.'
        ], 401);
    }

    // Register
    public function register(Request $request)
    {
        $rules = [
            'jenis'    => 'required|in:pembeli,penjual',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ];

        if ($request->jenis === 'pembeli') {
            $rules['name'] = 'required|string|max:255';
        } elseif ($request->jenis === 'penjual') {
            $rules['nama_toko']   = 'required|string|max:255';
            $rules['no_hp']       = 'required|numeric';
            $rules['alamat_toko'] = 'required|string|min:5';
        }

        $request->validate($rules, [
            'email.unique'         => 'Email ini sudah terdaftar!',
            'password.min'         => 'Kata sandi minimal harus 6 karakter.',
            'name.required'        => 'Nama Lengkap wajib diisi.',
            'nama_toko.required'   => 'Nama Toko wajib diisi.',
            'no_hp.required'       => 'Nomor HP wajib diisi.',
            'no_hp.numeric'        => 'Nomor HP harus berupa angka.',
            'alamat_toko.required' => 'Alamat Toko wajib diisi.',
        ]);

        $dataUser = [
            'jenis'    => $request->jenis,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ];

        if ($request->jenis === 'pembeli') {
            $dataUser['nama'] = $request->name;
            $dataUser['nama_toko'] = null;
            $dataUser['no_hp'] = null;
            $dataUser['alamat_toko'] = null;
            $dataUser['status_penjual'] = 'tidak_ada';
        } else {
            $dataUser['nama'] = $request->nama_toko; // Gunakan nama toko sebagai nama juga
            $dataUser['nama_toko'] = $request->nama_toko;
            $dataUser['no_hp'] = $request->no_hp;
            $dataUser['alamat_toko'] = $request->alamat_toko;
            $dataUser['status_penjual'] = 'pending';
        }

        $user = User::create($dataUser);
        Auth::login($user);

        // Tentukan redirect dan pesan
        if ($user->jenis === 'pembeli') {
            $redirect = '/user/home';
            $message = 'Pendaftaran berhasil!';
        } else {
            $redirect = '/user/home';
            $message = 'Pendaftaran berhasil! Akun Anda sedang menunggu persetujuan Admin.';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'user' => $user,
            'redirect_to' => $redirect
        ], 201);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return response()->json([
            'success' => true,
            'message' => 'Anda berhasil logout.',
            'redirect_to' => '/sesi/index'
        ]);
    }

    // Get current user
    public function me()
    {
        if (Auth::check()) {
            return response()->json([
                'success' => true,
                'user' => Auth::user()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tidak ada user yang login'
        ], 401);
    }
}

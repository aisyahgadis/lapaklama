<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    // Halaman Login
    public function index()
    {
        return view('sesi.index');
    }

    // Halaman Register
    public function register()
    {
        return view('sesi.register');
    }

    // PROSES LOGIN
    public function store(Request $request)
    {
        // Validasi login
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'jenis'    => 'required|in:pembeli,penjual',
        ], [
            'email.required'    => 'Email harus diisi',
            'email.email'       => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'jenis.required'    => 'Jenis akun harus dipilih',
        ]);

        // Data login (hanya email dan password untuk Auth::attempt)
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        $remember = $request->has('remember');

        // Coba login
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // Cek khusus admin
            if ($user->email === 'lapaklama@lapaklama.com' || $user->jenis === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }

            // Cek apakah jenis yang dipilih di form sesuai dengan jenis di database
            if ($user->jenis !== $request->jenis) {
                Auth::logout();
                return back()->withErrors([
                    'message' => 'Jenis akun tidak sesuai. Pastikan Anda memilih peran yang benar.',
                ])->onlyInput('email', 'jenis');
            }

            $request->session()->regenerate();

            // Redirect berdasarkan jenis
            if ($user->jenis === 'pembeli') {
                return redirect()->intended('/user/home');
            } elseif ($user->jenis === 'penjual') {
                if ($user->status_penjual === 'pending') {
                    return redirect()->intended('/user/home')->withErrors(['message' => 'Akun Penjual Anda masih dalam proses persetujuan oleh Admin.']);
                }
                return redirect()->intended('/main');
            } elseif ($user->jenis === 'penjahit') {
                return redirect()->intended('/penjahit/dashboard');
            }
        }

        return back()->withErrors([
            'message' => 'Login Gagal, pastikan email dan password yang Anda masukkan benar.',
        ])->onlyInput('email', 'jenis');
    }

    // ==========================================
    // BAGIAN REGISTRASI (DAFTAR BARU)
    // ==========================================

    public function storeRegister(Request $request)
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

        // Redirect berdasarkan jenis
        if ($user->jenis === 'pembeli') {
            return redirect()->to('/user/home')->with('success', 'Pendaftaran berhasil!');
        } else {
            return redirect()->to('/user/home')->with('success', 'Pendaftaran berhasil! Akun Anda sedang menunggu persetujuan Admin.');
        }
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/sesi/index')->with('success', 'Anda berhasil logout.');
    }
}
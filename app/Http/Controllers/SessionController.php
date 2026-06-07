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
        return view('sesi.index'); // Sesuaikan dengan nama file blade login kamu
    }

    // PROSES LOGIN (SUDAH DIUPDATE)
    public function store(Request $request)
    {
        // 1. Validasi input form login (Email, Password, dan Role)
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'role'     => 'required|in:pembeli,penjual',
        ], [
            'email.required'    => 'Email harus diisi',
            'email.email'       => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'role.required'     => 'Peran (Role) harus dipilih',
        ]);

        // 2. Menyusun data kredensial untuk dicocokkan ke database
        $infologin = [
            'email'    => $request->email,
            'password' => $request->password,
            'role'     => $request->role, // Memastikan user login sesuai dengan role-nya di db
        ];

        // Ambil opsi 'Ingat Saya'
        $remember = $request->has('remember');

        // 3. Validasi ke Database menggunakan Auth::attempt
        if (Auth::attempt($infologin, $remember)) {
            // Jika sukses, amankan session dan lempar ke /user/main
            $request->session()->regenerate();
            return redirect()->intended('/user/main');
        } else {
            // Jika gagal, kembalikan dengan pesan error
            return back()->withErrors([
                'message' => 'Login Gagal, pastikan email, password, dan peran yang Anda pilih benar.',
            ])->onlyInput('email', 'role');
        }
    }

    // ==========================================
    // BAGIAN REGISTRASI (DAFTAR BARU)
    // ==========================================

    // 1. Menampilkan Halaman Register
    public function register()
    {
        return view('sesi.register'); 
    }

    // 2. Memproses Data Register
    public function storeRegister(Request $request)
    {
        $rules = [
            'role'     => 'required|in:pembeli,penjual',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ];

        if ($request->role === 'pembeli') {
            $rules['name'] = 'required|string|max:255';
        } elseif ($request->role === 'penjual') {
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
            'role'     => $request->role,
            'email'    => $request->email,
            'username' => explode('@', $request->email)[0],
            'password' => Hash::make($request->password),
        ];

        if ($request->role === 'pembeli') {
            $dataUser['name'] = $request->name;
            $dataUser['nama_toko'] = null;
            $dataUser['no_hp'] = null;
            $dataUser['alamat_toko'] = null;
        } else {
            $dataUser['name'] = null;
            $dataUser['nama_toko'] = $request->nama_toko;
            $dataUser['no_hp'] = $request->no_hp;
            $dataUser['alamat_toko'] = $request->alamat_toko;
        }

        $user = User::create($dataUser);

        Auth::login($user);

        // DIUBAH: Setelah register juga langsung diarahkan ke /user/main
        return redirect()->to('/user/main')->with('success', 'Pendaftaran berhasil!');
    }
}
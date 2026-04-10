<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    function index()
    {
        return view('sesi.index');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Username harus diisi',
                'password.required' => 'Password harus diisi',
            ]
        );

        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            // sukses login
            return redirect()->intended('dashboard');
        } else {
            // gagal login
            return back()->withErrors([
                'message' => 'Login Gagal, pastikan username dan password benar',
            ]);
        }
    }
}
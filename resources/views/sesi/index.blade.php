@extends('layout.CRUD')

@section('content')
<nav class="navbar">
    <div class="logo">Lapaklama</div>
    <ul class="nav-links">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('jual') }}">Jual</a></li>
        <li><a href="{{ route('daurulang') }}">Daur Ulang</a></li>
        <li><a href="{{ route('login') }}" class="login-btn">Login</a></li>
    </ul>
</nav>
<div class="container">
    <header class="header">
        <h1>Login ke Lapaklama</h1>
        <p>Masukkan email dan password untuk masuk ke akun Anda.</p>
    </header>
    <section class="login-form">
        <form action="/sesi/login" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-btn">Login</button>
            <p class="register-link">Belum punya akun? <a href="#">Daftar di sini</a></p>
        </form>
    </section>
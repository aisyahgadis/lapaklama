@extends('layout.CRUD')
@section('title', 'Login')
@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="auth-wrapper">

    <div class="auth-card">

        <!-- KIRI -->
        <div class="auth-left">

            <div class="left-content">

                <span class="small-text">
                    SIGN IN
                </span>

                <h1>Lapak Lama</h1>

                <p>
                    Tempat Terbaik Menemukan Barang Klasik &
                    Otentik
                </p>

            </div>

            <div class="middle-button">
                <button>
                    MASUK
                </button>
            </div>
        </div>

        <!-- KANAN -->
        <div class="auth-right">

            <div class="user-icon">
                <i class="bi bi-person-fill"></i>
            </div>

            <h2>LOGIN</h2>
            <span class="subtitle">
                SIGN IN VIA AKUN
            </span>

            <form>

                <label>Masuk sebagai :</label>

                <div class="role-group">

                    <button
                        type="button"
                        class="role-btn active"
                        onclick="selectRole('pembeli')">
                        <i class="bi bi-bag-fill"></i>
                        Pembeli
                    </button>

                    <button
                        type="button"
                        class="role-btn"
                        onclick="selectRole('penjual')">
                        <i class="bi bi-shop"></i>
                        Penjual
                    </button>

                </div>

                <input
                    type="hidden"
                    id="role"
                    name="role">

                <div class="input-box">
                    <i class="bi bi-envelope-fill"></i>
                    <input
                        type="email"
                        placeholder="Username atau Email">
                </div>

                <div class="input-box">
                    <i class="bi bi-lock-fill"></i>
                    <input
                        type="password"
                        placeholder="Kata Sandi">
                </div>

                <div
                    id="alamat-box"
                    class="input-box alamat-box">

                    <i class="bi bi-geo-alt-fill"></i>

                    <textarea
                        placeholder="Alamat Toko"></textarea>

                </div>

                <a href="#" class="forgot">
                    Lupa Password?
                </a>

                <div class="login-action">

                    <button class="login-btn">
                        MASUK
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>

function selectRole(role){

    document.getElementById('role').value = role;

    let btns = document.querySelectorAll('.role-btn');

    btns.forEach(btn=>{
        btn.classList.remove('active');
    });

    event.currentTarget.classList.add('active');

    const alamat =
    document.getElementById('alamat-box');

    if(role === 'penjual'){
        alamat.style.display = 'flex';
    }else{
        alamat.style.display = 'none';
    }

}

window.onload = () => {
    document.getElementById('role').value='pembeli';
}

</script>
@endpush
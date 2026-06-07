@extends('layout.CRUD')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
    <div class="row login-container w-100 m-0">
        
        <div class="col-lg-6 login-form-section">
            <div class="brand-logo mb-5">
                <i class="bi bi-shop-window"></i>Lapaklama
            </div>

            <h2 class="fw-bold mb-2 text-dark">Selamat Datang Kembali!</h2>
            <p class="text-muted mb-4">Silakan masuk dengan akun Anda di bawah ini</p>

            @if ($errors->any())
                <div class="alert alert-danger py-2 small rounded-3 mb-4">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> 
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ url('/user/main') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="form-label text-muted small fw-semibold d-block">Masuk Sebagai</label>
                    <div class="btn-group w-100" role="group" aria-label="Pilihan Role">
                        <input type="radio" class="btn-check" name="role" id="role_pembeli" value="pembeli" {{ old('role', 'pembeli') == 'pembeli' ? 'checked' : '' }} autocomplete="off">
                        <label class="btn btn-outline-tosca w-50 py-2 d-flex align-items-center justify-content-center gap-2" for="role_pembeli">
                            <i class="bi bi-cart3"></i> Pembeli
                        </label>

                        <input type="radio" class="btn-check" name="role" id="role_penjual" value="penjual" {{ old('role') == 'penjual' ? 'checked' : '' }} autocomplete="off">
                        <label class="btn btn-outline-tosca w-50 py-2 d-flex align-items-center justify-content-center gap-2" for="role_penjual">
                            <i class="bi bi-shop"></i> Penjual
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label text-muted small fw-semibold">Alamat Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-muted small fw-semibold">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="••••••••••••" required>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4 small">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label text-muted" for="remember">Ingat Saya</label>
                    </div>
                    <a href="#" class="text-tosca text-decoration-none fw-semibold">Lupa Kata Sandi?</a>
                </div>

                <button type="submit" class="btn btn-tosca w-100 rounded-3 mb-4 py-2">Masuk</button>

            </form>

            <div class="mt-5 text-center">
                <p class="text-muted small mb-0">Belum punya akun? <a href="{{ url('/sesi/register') }}" class="text-tosca text-decoration-none fw-bold">Daftar Akun</a></p>
                <p class="text-muted small mt-4">&copy; 2026 Lapaklama</p>
            </div>
        </div>

        <div class="col-lg-6 login-visual-section d-none d-lg-flex">
            <div class="visual-bg-pattern">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </div>
            
            <div class="visual-icon">
                <i class="bi bi-person-workspace"></i>
            </div>
            
            <h3 class="fw-bold mb-2 text-center">Form Login Lapaklama</h3>
            <p class="text-center opacity-75 small" style="max-width: 340px;">
                Kelola data, pantau transaksi, dan kembangkan bisnis Anda dengan lebih mudah dalam satu tempat.
            </p>
        </div>

    </div>
</div>
@endsection
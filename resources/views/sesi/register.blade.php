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

            <h2 class="fw-bold mb-2 text-dark">Selamat Datang!</h2>
            <p class="text-muted mb-4">Silakan isi formulir di bawah ini untuk mendaftar akun</p>

            @if ($errors->any())
                <div class="alert alert-danger py-2 small">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/sesi/register') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="form-label text-muted small fw-semibold d-block">Daftar Sebagai</label>
                    <div class="btn-group w-100" role="group" aria-label="Pilihan Role">
                        <input type="radio" class="btn-check" name="role" id="role_pembeli" value="pembeli" checked autocomplete="off">
                        <label class="btn btn-outline-tosca w-50 py-2 d-flex align-items-center justify-content-center gap-2" for="role_pembeli">
                            <i class="bi bi-cart3"></i> Pembeli
                        </label>

                        <input type="radio" class="btn-check" name="role" id="role_penjual" value="penjual" autocomplete="off">
                        <label class="btn btn-outline-tosca w-50 py-2 d-flex align-items-center justify-content-center gap-2" for="role_penjual">
                            <i class="bi bi-shop"></i> Penjual
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label text-muted small fw-semibold">Alamat Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-muted small fw-semibold">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="••••••••••••" required>
                </div>

                <div id="pembeli-fields">
                    <div class="mb-3">
                        <label for="name" class="form-label text-muted small fw-semibold">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div id="penjual-fields" class="d-none">
                    <div class="mb-3">
                        <label id="label_nama_toko" for="nama_toko" class="form-label text-muted small fw-semibold">Nama Toko</label>
                        <input type="text" class="form-control" id="nama_toko" name="nama_toko" placeholder="Masukkan nama toko Anda" value="{{ old('nama_toko') }}">
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="form-label text-muted small fw-semibold">Nomor HP</label>
                        <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="08xxxxxxxxxx" value="{{ old('no_hp') }}">
                    </div>

                    <div class="mb-3">
                        <label for="alamat_toko" class="form-label text-muted small fw-semibold">Alamat Toko</label>
                        <textarea class="form-control" id="alamat_toko" name="alamat_toko" rows="2" placeholder="Masukkan alamat lengkap toko Anda">{{ old('alamat_toko') }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-tosca w-100 rounded-3 mb-4 mt-2 py-2">Daftar Sekarang</button>
            </form>

            <div class="mt-4 text-center">
                <p class="text-muted small mb-0">Sudah punya akun? <a href="{{ url('/sesi/index') }}" class="text-tosca text-decoration-none fw-bold">Masuk Akun</a></p>
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
            <h3 class="fw-bold mb-2 text-center">Form Register Lapaklama</h3>
            <p class="text-center opacity-75 small" style="max-width: 340px;">
                Mulai kelola data, pantau transaksi, dan kembangkan bisnis Anda dengan lebih mudah dalam satu tempat.
            </p>
        </div>

    </div>
</div>

<script>
    document.querySelectorAll('input[name="role"]').forEach((elem) => {
        elem.addEventListener("change", function(event) {
            const pembeliFields = document.getElementById('pembeli-fields');
            const penjualFields = document.getElementById('penjual-fields');
            
            const nameInput = document.getElementById('name');
            const namaTokoInput = document.getElementById('nama_toko');
            const noHpInput = document.getElementById('no_hp');
            const alamatTokoInput = document.getElementById('alamat_toko');

            if (event.target.value === 'penjual') {
                // Sembunyikan form pembeli, hilangkan required
                pembeliFields.classList.add('d-none');
                nameInput.removeAttribute('required');

                // Tampilkan form penjual, aktifkan required
                penjualFields.classList.remove('d-none');
                namaTokoInput.setAttribute('required', 'required');
                noHpInput.setAttribute('required', 'required');
                alamatTokoInput.setAttribute('required', 'required');
            } else {
                // Tampilkan form pembeli, aktifkan required
                pembeliFields.classList.remove('d-none');
                nameInput.setAttribute('required', 'required');

                // Sembunyikan form penjual, hilangkan required
                penjualFields.classList.add('d-none');
                namaTokoInput.removeAttribute('required');
                noHpInput.removeAttribute('required');
                alamatTokoInput.removeAttribute('required');
            }
        });
    });
</script>
@endsection
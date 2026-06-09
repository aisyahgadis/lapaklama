@extends('layout.user')

@section('title', 'Edit Profil')

@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
    <div class="card shadow-sm p-4" style="max-width: 600px; width: 100%;">
        
        <h2 class="fw-bold mb-2 text-dark">Edit Profil</h2>
        <p class="text-muted mb-4">Perbarui informasi akun Anda pada formulir di bawah ini</p>

        @if ($errors->any())
            <div class="alert alert-danger py-2 small">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success py-2 small">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="form-label text-muted small fw-semibold d-block">Tipe Akun</label>
                <span class="badge bg-secondary px-3 py-2 text-uppercase d-inline-flex align-items-center gap-1">
                    @if($user->jenis === 'penjual')
                        <i class="bi bi-shop"></i> Penjual
                    @elseif($user->jenis === 'penjahit')
                        <i class="bi bi-scissors"></i> Penjahit
                    @else
                        <i class="bi bi-cart3"></i> Pembeli
                    @endif
                </span>
                <small class="d-block text-muted mt-1" style="font-size: 0.75rem;">*Tipe akun tidak dapat diubah</small>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label text-muted small fw-semibold">Alamat Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label text-muted small fw-semibold">Kata Sandi Baru (Opsional)</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin diubah">
            </div>

            @if($user->jenis === 'pembeli')
                <div class="mb-3">
                    <label for="nama" class="form-label text-muted small fw-semibold">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap Anda" value="{{ old('nama', $user->nama) }}" required>
                </div>
            @elseif($user->jenis === 'penjual')
                <div class="mb-3">
                    <label id="label_nama_toko" for="nama_toko" class="form-label text-muted small fw-semibold">Nama Toko</label>
                    <input type="text" class="form-control" id="nama_toko" name="nama_toko" placeholder="Masukkan nama toko Anda" value="{{ old('nama_toko', $user->nama_toko) }}" required>
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label text-muted small fw-semibold">Nomor HP</label>
                    <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="08xxxxxxxxxx" value="{{ old('no_hp', $user->no_hp) }}" required>
                </div>

                <div class="mb-3">
                    <label for="alamat_toko" class="form-label text-muted small fw-semibold">Alamat Toko</label>
                    <textarea class="form-control" id="alamat_toko" name="alamat_toko" rows="2" placeholder="Masukkan alamat lengkap toko Anda" required>{{ old('alamat_toko', $user->alamat_toko) }}</textarea>
                </div>
            @elseif($user->jenis === 'penjahit')
                <div class="mb-3">
                    <label for="nama" class="form-label text-muted small fw-semibold">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap Anda" value="{{ old('nama', $user->nama) }}" required>
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label text-muted small fw-semibold">Nomor HP (Opsional)</label>
                    <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="08xxxxxxxxxx" value="{{ old('no_hp', $user->no_hp) }}">
                </div>
            @endif

            <div class="d-flex gap-2 mt-4 mb-4">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-50 rounded-3 py-2">Batal</a>
                <button type="submit" class="btn btn-primary w-50 rounded-3 py-2">Simpan Profil</button>
            </div>
        </form>

    </div>
</div>
@endsection

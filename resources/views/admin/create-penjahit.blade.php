@extends('layout.admin')
@section('title', 'Tambah Penjahit')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<style>
    .form-container {
        max-width: 600px;
        margin: 40px auto;
        padding: 30px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    }
    .form-group {
        margin-bottom: 24px;
    }
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #2d3748;
        font-size: 14px;
    }
    .form-control {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        font-size: 14px;
    }
    .btn-group {
        display: flex;
        gap: 12px;
    }
    .btn {
        flex: 1;
        padding: 12px 16px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }
    .btn-secondary {
        border: 1px solid #e2e8f0;
        color: #4a5568;
        background: white;
        text-decoration: none;
        text-align: center;
    }
    .btn-primary {
        background: var(--primary-color, #1b7a8c);
        color: white;
    }
    .btn-primary:hover {
        background: #0b5f75;
    }
    .alert {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<div class="dashboard-container">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-error">
            <i class="bi bi-exclamation-triangle"></i> {{ $errors->first() }}
        </div>
    @endif

    <div class="form-container">
        <form method="POST" action="{{ route('admin.penjahit.store') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Penjahit</label>
                <input type="text" name="nama" id="nama" required class="form-control" value="{{ old('nama') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" id="email" required class="form-control" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" id="password" required class="form-control">
            </div>

            <div class="form-group">
                <label class="form-label">Nomor HP</label>
                <input type="text" name="no_hp" id="no_hp" required class="form-control" value="{{ old('no_hp') }}">
            </div>

            <div class="btn-group">
                <a href="{{ route('admin.recycle-detail') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" id="btn-simpan" class="btn btn-primary">
                    <i class="bi bi-save"></i> Tambahkan Penjahit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

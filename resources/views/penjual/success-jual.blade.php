@extends('layout.web')

@section('title', 'Barang Berhasil Dijual')
@section('content')
<link rel="stylesheet" href="{{ asset('css/success-jual.css') }}">
    <div class="success-wrapper">
        <div class="success-card">
            <div class="icon-circle">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
            
            <h1 class="success-title">Barang Berhasil Dijual!</h1>
            <p class="success-message">
                Selamat! Transaksi barang daganganmu telah berhasil diproses dan dicatat dalam sistem. Terus tingkatkan penjualan tokomu.
            </p>
            
            <div class="action-buttons">
                <a href="{{ route('main') }}" class="btn btn-outline">Kembali ke Dashboard</a>
                <a href="{{ route('penjual.product') }}" class="btn btn-outline">Lihat Daftar Product</a>
            </div>
        </div>
    </div>
@endsection
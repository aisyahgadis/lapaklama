@extends('layout.admin')

@section('title', 'Data Produk')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
<div class="container-fluid">
    
    <div class="page-header">
        <div class="header-title">
            <h2>Manajemen Produk</h2>
            <p>Kelola produk yang terdaftar di sistem</p>
        </div>
        
        <div class="counter-card">
            <div class="counter-icon"></div>
            <div class="counter-info">
                <span class="counter-label">TOTAL PRODUK</span>
                <span class="counter-value">{{ $totalProduk }}</span>
            </div>
        </div>
    </div>

    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 8%;">NO</th>
                    <th style="width: 25%;">NAMA PRODUK / DESKRIPSI</th>
                    <th style="width: 20%;">KATEGORI</th>
                    <th style="width: 18%;">HARGA</th>
                    <th style="width: 14%;">STOK</th>
                    <th style="width: 15%;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    
                    <td class="fw-bold">{{ $product->nama_produk ?? $product->deskripsi }}</td>
                    
                    <td>{{ $product->kategori ?? 'Umum' }}</td>
                    
                    <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                    
                    <td>{{ $product->stok ?? '1' }} Pcs</td>
                    
                    <td>
                        <button class="btn-detail">Detail</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px;">
                        Belum ada produk yang terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
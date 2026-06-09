@extends('layout.user')

@section('content')
<link rel="stylesheet" href="{{ asset('css/view-product.css') }}">

<div class="product-container">
    <div class="product-image">
        <img src="{{ asset('storage/' . $product->gambar) }}" alt="Produk">
    </div>

    <div class="product-details">
        <h1 class="product-title">{{ $product->nama }}</h1>
            <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 15px;">Kategori: {{ ucfirst($product->kategori ?? 'Umum') }}</p>
        <p class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
        
        <p class="product-description">
            {{ $product->deskripsi }}
        </p>

        <ul class="product-specs">
            <li><strong>Status:</strong> {{ $product->status === 'tersedia' ? 'Tersedia' : 'Terjual' }}</li>
            <li><strong>Kategori:</strong> {{ $product->kategori }}</li>
        </ul>

        <a href="{{ route('user.checkout', $product->id) }}" class="btn btn-primary">Beli Sekarang</a>
    </div>
</div>
@endsection
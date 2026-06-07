@extends('layout.user')

@section('content')
<link rel="stylesheet" href="{{ asset('css/view-product.css') }}">

<div class="product-container">
    <div class="product-image">
        <img src="https://via.placeholder.com/500x600?text=Gambar+Baju" alt="Kemeja Flanel Dummy">
    </div>

    <div class="product-details">
        <h1 class="product-title">Kemeja Flanel Kotak-Kotak (Dummy)</h1>
        <p class="product-price">Rp 150.000</p>
        
        <p class="product-description">
            Kemeja flanel premium dengan bahan yang nyaman dan menyerap keringat. Cocok digunakan untuk hangout atau acara kasual.
        </p>

        <ul class="product-specs">
            <li><strong>Bahan:</strong> Katun Flanel</li>
            <li><strong>Ukuran:</strong> M, L, XL</li>
            <li><strong>Warna:</strong> Merah Hitam</li>
            <li><strong>Stok:</strong> Tersedia (24 pcs)</li>
        </ul>

        <button class="btn-buy">Beli</button>
    </div>
</div>
@endsection
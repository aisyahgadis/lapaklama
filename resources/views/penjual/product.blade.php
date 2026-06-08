@extends('layout.web')
@section('title', 'Daftar Produk Saya')
@section('content')
<link rel="stylesheet" href="{{ asset('css/seller-product.css') }}">

{{-- Membuat Dummy Data langsung di Blade --}}
@php
    $dummyProducts = [
        (object)[
            'id' => 1,
            'name' => 'Sepatu Sneakers Pria',
            'price' => 250000,
            'sold_qty' => 15,
            'image' => 'https://via.placeholder.com/250x200/eee/333?text=Sepatu+Sneakers'
        ],
        (object)[
            'id' => 2,
            'name' => 'Kemeja Flannel Kotak',
            'price' => 120000,
            'sold_qty' => 42,
            'image' => 'https://via.placeholder.com/250x200/eee/333?text=Kemeja+Flannel'
        ],
        (object)[
            'id' => 3,
            'name' => 'Jam Tangan Minimalis',
            'price' => 350000,
            'sold_qty' => 8,
            'image' => 'https://via.placeholder.com/250x200/eee/333?text=Jam+Tangan'
        ],
        (object)[
            'id' => 4,
            'name' => 'Tas Ransel Kanvas',
            'price' => 180000,
            'sold_qty' => 25,
            'image' => 'https://via.placeholder.com/250x200/eee/333?text=Tas+Ransel'
        ]
    ];
@endphp

<div class="product-dashboard">
    
    <div class="dashboard-header">
        <h1>Daftar Produk Saya</h1>
        {{-- Link menuju form tambah produk --}}
        <a href="{{ route('penjual.edit-product') }}" class="btn-add">+ Tambah Produk</a>
    </div>

    <div class="product-grid">
        {{-- Looping menggunakan data dummy --}}
        @foreach ($dummyProducts as $product)
            <div class="product-card">
                {{-- Gambar menggunakan URL dari data dummy --}}
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">
                
                <div class="product-info">
                    <h3 class="product-title">{{ $product->name }}</h3>
                    <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    <div class="product-stats">Terjual: {{ $product->sold_qty }} pcs</div>
                </div>

                <div class="product-actions">
                    {{-- Tombol Edit --}}
                    <a href="{{ route('penjual.edit-product', ['id' => $product->id]) }}" class="btn-action btn-edit">Edit</a>
                    
                    {{-- Tombol Hapus dengan Notif Konfirmasi --}}
                    <form action="#" class="form-delete" onsubmit="event.preventDefault(); if(confirm('Apakah Anda yakin ingin menghapus produk {{ $product->name }}?')) { alert('Hapus produk ID: {{ $product->id }} (Dummy)'); }">
                        <button type="submit" class="btn-action btn-delete">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
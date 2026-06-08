@extends('layout.web')

@section('title','Katalog Baju')

@section('content')
<link rel="stylesheet" href="{{ asset('css/beli.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<div class="beli-page">
    
    <form action="{{ route('user.buy-user') }}" method="GET">
        <header class="hero-search">
            <div class="hero-content">
                <span class="hero-badge">👕 Koleksi Fashion Terbaru</span>
                <h1>Lapaklama Fashion Centre</h1>
                <p>Cari baju bekas terbaikmu dengan kualitas juara</p>

                <div class="search-container">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" name="search" class="search-input" value="{{ request('search') }}" placeholder="Cari baju bekas, jaket vintage...">
                    <button type="submit" class="btn-search">Cari</button>
                </div>
            </div>
        </header>

        <section class="shop-container">
            <div class="filters">
                <div class="filter-group">
                    <select name="kategori" class="custom-select" onchange="this.form.submit()">
                        <option value="all" {{ request('kategori') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                        <option value="jaket" {{ request('kategori') == 'jaket' ? 'selected' : '' }}>Jaket</option>
                        <option value="kemeja" {{ request('kategori') == 'kemeja' ? 'selected' : '' }}>Kemeja</option>
                        <option value="kaos" {{ request('kategori') == 'kaos' ? 'selected' : '' }}>Kaos</option>
                        <option value="celana" {{ request('kategori') == 'celana' ? 'selected' : '' }}>Celana</option>
                        <option value="dress" {{ request('kategori') == 'dress' ? 'selected' : '' }}>Dress</option>
                    </select>
                </div>

                <div class="price-filter relative">
                    <div class="price-inputs">
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min (Rp)" min="0">
                        <span class="divider">-</span>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max (Rp)" min="0">
                        <button type="submit" class="btn-apply" style="margin-left: 10px;">Filter Harga</button>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <section class="shop-container">
        <div class="product-grid" id="productGrid">
            
            @if(session('success'))
                <div class="alert alert-success" style="grid-column: 1 / -1; color: green; margin-bottom: 15px;">
                    {{ session('success') }}
                </div>
            @endif

            @forelse($products as $product)
                <div class="product-card" data-category="{{ $product->kategori ?? 'all' }}" data-price="{{ $product->harga }}">
                    <div class="product-img-wrapper">
                        <img src="{{ asset('storage/' . $product->gambar) }}" alt="Gambar Produk">
                    </div>
                    <div class="product-info">
                        <h3>Produk Fashion #{{ $product->id }}</h3> 
                        <p class="product-desc">{{ $product->deskripsi }}</p>
                        
                        <div class="price-action">
                            <span class="price">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                            
                            <a href="{{ route('user.view-product', $product->id) }}" class="btn-buy" style="text-decoration: none;">
                                <i class="bi bi-eye"></i> Lihat Detail
                            </a>
                        </div>
                            
                            <form action="{{ route('user.buy-user', $product->id) }}" method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" class="btn-buy" onclick="return confirm('Apakah kamu yakin ingin membeli barang ini?')">
                                    <i class="bi bi-cart-plus"></i> Beli
                                </button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 50px;">
                    <p>Yah, sepertinya belum ada produk yang sesuai dengan filtermu atau sudah laku semua.</p>
                    <a href="{{ route('user.buy-user') }}" class="btn-apply" style="display:inline-block; margin-top:10px;">Reset Filter</a>
                </div>
            @endforelse

        </div>
    </section>
</div>
@endsection
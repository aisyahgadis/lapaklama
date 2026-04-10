@extends('layout.web')

@section('title','Katalog Baju')

@section('content')
<link rel="stylesheet" href="{{ asset('css/beli.css') }}">
<script src="{{ asset('js/beli.js') }}"></script>
<section class="hero-search">

    <div class="hero-content">

    <h1>Lapaklama Fashion Centre</h1>
    <p>Cari baju bekas terbaikmu</p>

        <div class="search-container">

            <i class="bi bi-search search-icon"></i>

            <input 
            type="text" 
            class="search-input" 
            placeholder="Cari baju bekas, jaket vintage dan fashion bekas lainnya..."
            id="searchInput">

        </div>

    </div>

</section>

<section class="shop-container">
    <div class="filters">

        <!-- KATEGORI -->
        <select id="categoryFilter">
            <option value="all">Semua Kategori</option>
            <option value="jaket">Jaket</option>
            <option value="kemeja">Kemeja</option>
            <option value="kaos">Kaos</option>
            <option value="celana">Celana</option>
        </select>

            <!-- BUTTON HARGA -->
        <div class="price-filter">

            <button onclick="togglePriceCard()" class="price-btn">
                Harga
            </button>

            <!-- CARD -->
            <div class="price-card" id="priceCard">

                <p>Range Harga</p>

                <input type="number" id="minPrice" placeholder="Min (Rp)" min="0">
                <input type="number" id="maxPrice" placeholder="Max (Rp)" min="0">

                <button onclick="applyPrice()">Terapkan</button>

            </div>
        </div>
    </div>
    </div>

    <!-- PRODUK -->
    <div class="product-grid" id="productGrid">

        <div class="product-card" data-category="jaket" data-price="120000">
            <img src="https://i.pinimg.com/1200x/6a/06/ab/6a06abbe6d5a0651a2cc2233f16eb981.jpg">
            <h3>Jaket Vintage</h3>
            <p>Rp 120.000</p>
        </div>

        <div class="product-card" data-category="kemeja" data-price="75000">
            <img src="https://i.pinimg.com/1200x/1c/13/7b/1c137b62f2cb80630aa00fa9a07f5a14.jpg">
            <h3>Kemeja Flanel</h3>
            <p>Rp 75.000</p>
        </div>

        <div class="product-card" data-category="celana" data-price="90000">
            <img src="https://i.pinimg.com/1200x/11/cf/5b/11cf5bffa4c0588256885044c62aef8f.jpg">
            <h3>Celana Denim</h3>
            <p>Rp 90.000</p>
        </div>

        <div class="product-card" data-category="kaos" data-price="40000">
            <img src="https://i.pinimg.com/1200x/d9/54/6b/d9546ba16c59e87e80096b303bb73bae.jpg">
            <h3>Kaos Santai</h3>
            <p>Rp 40.000</p>
        </div>

    </div>

</section>

@endsection
@extends('layout.user')

@section('title','Katalog Baju')

@section('content')
<link rel="stylesheet" href="{{ asset('css/beli.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="{{ asset('js/beli.js') }}"></script>

<section class="hero-search">
    <div class="hero-content">
        <h1>Lapaklama Fashion Centre</h1>
        <p>Cari baju bekas terbaikmu dengan kualitas juara</p>

        <div class="search-container">
            <i class="bi bi-search search-icon"></i>
            <input 
                type="text" 
                class="search-input" 
                placeholder="Cari baju bekas, jaket vintage dan fashion lainnya..."
                id="searchInput">
            <button class="btn-search">Cari</button>
        </div>
    </div>
</section>

<section class="shop-container">
    <div class="filters">
        <div class="filter-group">
            <select id="categoryFilter" class="custom-select">
                <option value="all">Semua Kategori</option>
                <option value="jaket">Jaket</option>
                <option value="kemeja">Kemeja</option>
                <option value="kaos">Kaos</option>
                <option value="celana">Celana</option>
                <option value="dress">Dress</option>
            </select>
        </div>

        <div class="price-filter relative">
            <button onclick="togglePriceCard()" class="price-btn">
                <i class="bi bi-funnel"></i> Harga
            </button>

            <div class="price-card" id="priceCard">
                <p class="filter-title">Range Harga</p>
                <div class="price-inputs">
                    <input type="number" id="minPrice" placeholder="Min (Rp)" min="0">
                    <span class="divider">-</span>
                    <input type="number" id="maxPrice" placeholder="Max (Rp)" min="0">
                </div>
                <button onclick="applyPrice()" class="btn-apply">Terapkan</button>
            </div>
        </div>
    </div>

    <div class="product-grid" id="productGrid">

        <div class="product-card" data-category="jaket" data-price="120000">
            <div class="product-img-wrapper">
                <img src="https://i.pinimg.com/1200x/6a/06/ab/6a06abbe6d5a0651a2cc2233f16eb981.jpg" alt="Jaket Vintage">
            </div>
            <div class="product-info">
                <h3>Jaket Vintage Biru</h3>
                <p class="product-desc">Jaket rajut bergaya vintage dengan detail pita lucu, cocok untuk OOTD kasual.</p>
                <div class="price-action">
                    <span class="price">Rp 120.000</span>
                    <button class="btn-buy"><i class="bi bi-cart-plus"></i> Beli</button>
                </div>
            </div>
        </div>

        <div class="product-card" data-category="kemeja" data-price="75000">
            <div class="product-img-wrapper">
                <img src="https://i.pinimg.com/1200x/1c/13/7b/1c137b62f2cb80630aa00fa9a07f5a14.jpg" alt="Kemeja Flanel">
            </div>
            <div class="product-info">
                <h3>Kemeja Motif Klasik</h3>
                <p class="product-desc">Kemeja dengan kancing unik gaya oriental, bahan adem dan nyaman dipakai seharian.</p>
                <div class="price-action">
                    <span class="price">Rp 75.000</span>
                    <button class="btn-buy"><i class="bi bi-cart-plus"></i> Beli</button>
                </div>
            </div>
        </div>

        <div class="product-card" data-category="celana" data-price="90000">
            <div class="product-img-wrapper">
                <img src="https://i.pinimg.com/1200x/11/cf/5b/11cf5bffa4c0588256885044c62aef8f.jpg" alt="Celana Denim">
            </div>
            <div class="product-info">
                <h3>Celana Denim Loose</h3>
                <p class="product-desc">Celana jeans potongan longgar yang trendy, cocok dipadukan dengan atasan apa saja.</p>
                <div class="price-action">
                    <span class="price">Rp 90.000</span>
                    <button class="btn-buy"><i class="bi bi-cart-plus"></i> Beli</button>
                </div>
            </div>
        </div>

        <div class="product-card" data-category="dress" data-price="140000">
            <div class="product-img-wrapper">
                <img src="https://i.pinimg.com/1200x/d9/54/6b/d9546ba16c59e87e80096b303bb73bae.jpg" alt="Dress Kotak-kotak">
            </div>
            <div class="product-info">
                <h3>Midi Dress Tartan</h3>
                <p class="product-desc">Dress bermotif kotak-kotak klasik dengan sabuk kulit elegan untuk gaya retro.</p>
                <div class="price-action">
                    <span class="price">Rp 140.000</span>
                    <button class="btn-buy"><i class="bi bi-cart-plus"></i> Beli</button>
                </div>
            </div>
        </div>

        <div class="product-card" data-category="kaos" data-price="45000">
            <div class="product-img-wrapper">
                <img src="https://i.pinimg.com/564x/2b/3b/b1/2b3bb16be2340ff6aebbe1fb010fc2a5.jpg" alt="Kaos Band">
            </div>
            <div class="product-info">
                <h3>Kaos Band Retro</h3>
                <p class="product-desc">Kaos katun sablon band vintage tahun 90an. Kondisi sangat baik tanpa noda.</p>
                <div class="price-action">
                    <span class="price">Rp 45.000</span>
                    <button class="btn-buy"><i class="bi bi-cart-plus"></i> Beli</button>
                </div>
            </div>
        </div>

        <div class="product-card" data-category="jaket" data-price="150000">
            <div class="product-img-wrapper">
                <img src="https://i.pinimg.com/564x/8a/89/3b/8a893badc8dcdfc8b4d8d1f7c22938f3.jpg" alt="Jaket Kulit">
            </div>
            <div class="product-info">
                <h3>Jaket Kulit Biker</h3>
                <p class="product-desc">Jaket kulit sintetis hitam dengan ritsleting asimetris. Tampil garang dan stylish.</p>
                <div class="price-action">
                    <span class="price">Rp 150.000</span>
                    <button class="btn-buy"><i class="bi bi-cart-plus"></i> Beli</button>
                </div>
            </div>
        </div>

        <div class="product-card" data-category="celana" data-price="85000">
            <div class="product-img-wrapper">
                <img src="https://i.pinimg.com/564x/6c/fb/2e/6cfb2ebc4d168593a6e353fde1a5e01b.jpg" alt="Celana Kargo">
            </div>
            <div class="product-info">
                <h3>Celana Kargo Coklat</h3>
                <p class="product-desc">Celana kargo dengan banyak kantong fungsional. Material kanvas tebal dan awet.</p>
                <div class="price-action">
                    <span class="price">Rp 85.000</span>
                    <button class="btn-buy"><i class="bi bi-cart-plus"></i> Beli</button>
                </div>
            </div>
        </div>

        <div class="product-card" data-category="kemeja" data-price="60000">
            <div class="product-img-wrapper">
                <img src="https://i.pinimg.com/564x/e7/bc/c7/e7bcc7ddc2ed2c5ce56b3e0cbebb6c0c.jpg" alt="Kemeja Corduroy">
            </div>
            <div class="product-info">
                <h3>Kemeja Corduroy</h3>
                <p class="product-desc">Kemeja bahan corduroy halus warna earth tone. Bisa dipakai sebagai outer/jaket tipis.</p>
                <div class="price-action">
                    <span class="price">Rp 60.000</span>
                    <button class="btn-buy"><i class="bi bi-cart-plus"></i> Beli</button>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
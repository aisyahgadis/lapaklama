@extends('layout.web')
@section('title','main')
@section('content')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">

<section class="hero">

    <div class="hero-text">
        <h1>Lapaklama</h1>
        <h2>Lifestyle Rewear Products</h2>

        <p>
            Jual baju bekasmu atau ubah menjadi fashion baru melalui layanan daur ulang kami.
            Temukan gaya unik sambil membantu mengurangi limbah fashion.
        </p>

        <div class="hero-buttons">
            <a href="#" class="btn-primary">Mulai Sekarang</a>
            <a href="#" class="btn-outline">Lihat Produk</a>
        </div>
    </div>

    <div class="hero-gallery">

        <div class="diamond">
            <img src="https://i.pinimg.com/1200x/6f/6f/7a/6f6f7aa22e7b00b9abeba24478a0a37e.jpg">
        </div>

        <div class="diamond">
            <img src="https://i.pinimg.com/1200x/6f/6f/7a/6f6f7aa22e7b00b9abeba24478a0a37e.jpg">
        </div>

        <div class="diamond">
            <img src="https://i.pinimg.com/1200x/6f/6f/7a/6f6f7aa22e7b00b9abeba24478a0a37e.jpg">
        </div>

        <div class="diamond">
            <img src="https://i.pinimg.com/1200x/6f/6f/7a/6f6f7aa22e7b00b9abeba24478a0a37e.jpg">
        </div>

    </div>
</section>

<section class="hero-search">

    <div class="hero-content">

    <h1>Lapaklama Fashion Centre</h1>
    <p>Cari baju bekas atau ide daur ulang fashion</p>

        <div class="search-container">

            <i class="bi bi-search search-icon"></i>

            <input 
            type="text" 
            class="search-input" 
            placeholder="Cari baju bekas, jaket vintage, ide daur ulang..."
            id="searchInput">

        </div>

    </div>

</section>
<section class="produk-section">

    <h2 class="section-title">Produk Terbaru</h2>

    <div class="slider-container">

        <button class="slider-btn left">&#10094;</button>

        <div class="product-slider">

            <div class="product-card">
                <img src="https://i.pinimg.com/webp/1200x/42/8d/fb/428dfb1e3d23fa5b022393a7c46199ac.webp">
                <h3>Vintage T-shirt</h3>
                <p>Rp 45.000</p>
            </div>

            <div class="product-card">
                <img src="https://i.pinimg.com/webp/1200x/42/8d/fb/428dfb1e3d23fa5b022393a7c46199ac.webp">
                <h3>Oversize Hoodie</h3>
                <p>Rp 70.000</p>
            </div>

            <div class="product-card">
                <img src="https://i.pinimg.com/webp/1200x/42/8d/fb/428dfb1e3d23fa5b022393a7c46199ac.webp">
                <h3>Upcycle Denim Jacket</h3>
                <p>Rp 120.000</p>
            </div>

            <div class="product-card">
                <img src="https://i.pinimg.com/webp/1200x/42/8d/fb/428dfb1e3d23fa5b022393a7c46199ac.webp">
                <h3>Patchwork Shirt</h3>
                <p>Rp 95.000</p>
            </div>

            <div class="product-card">
                <img src="https://i.pinimg.com/webp/1200x/42/8d/fb/428dfb1e3d23fa5b022393a7c46199ac.webp">
                <h3>Retro Sweater</h3>
                <p>Rp 60.000</p>
            </div>

        </div>

        <button class="slider-btn right">&#10095;</button>
        
        <div class="see-more">
            <a href="#">Lihat Semua</a>
        </div>

    </div>

</section>
</div>
<section class="recycle-collection">

    <h2>Discover Recycle Collection</h2>
    <p class="subtitle">Baju lama yang diubah menjadi fashion baru</p>

    <div class="recycle-slider-container">

        <button class="recycle-btn left">&#10094;</button>

        <div class="recycle-slider">

            <img src="https://i.pinimg.com/736x/b1/eb/82/b1eb8227368bd1153138d7bb84cba72c.jpg" class="recycle-item">
            <img src="https://i.pinimg.com/736x/b1/eb/82/b1eb8227368bd1153138d7bb84cba72c.jpg" class="recycle-item">
            <img src="https://i.pinimg.com/736x/b1/eb/82/b1eb8227368bd1153138d7bb84cba72c.jpg" class="recycle-item">
            <img src="https://i.pinimg.com/736x/b1/eb/82/b1eb8227368bd1153138d7bb84cba72c.jpg" class="recycle-item">
            <img src="https://i.pinimg.com/736x/b1/eb/82/b1eb8227368bd1153138d7bb84cba72c.jpg" class="recycle-item">

        </div>

        <button class="recycle-btn right">&#10095;</button>

    </div>

    <div class="see-more">
        <a href="#">Lihat Semua</a>
    </div>

</section>
<section>
    <div class ="cobain">
            <h2 class="title">Ayo coba Lapaklama sekarang!</h2>
        <main class="main">
            <div class="card">
                <h2>Jual Baju Bekasmu</h2>
                <p>Ubah baju bekasmu menjadi uang dengan mudah di Lapaklama. Cukup daftar, unggah foto, dan jual!</p>
                <a href="{{ route('jual') }}" class="btn">Jual Sekarang</a>
            </div>
            <div class="card">
                <h2>Beli Baju Bekas Berkualitas</h2>
                <p>Temukan baju bekas berkualitas dengan harga terjangkau di Lapaklama. Cari, pilih, dan beli dengan mudah!</p>
                <a href="{{ route('baju') }}" class="btn">Belanja Sekarang</a>
            </div>
            <div class="card">
                <h2>Ubah Baju Lamamu Jadi Lebih Bernilai</h2>
                <p>Lapaklama membantu kamu mengubah baju lamamu menjadi lebih bernilai. Jual atau beli baju bekas dengan mudah dan cepat!</p>
                <a href="{{ route('daurulang') }}" class="btn">Mulai Sekarang</a>
            </div>
        </main>
        <!--Tentang Section -->
    </div>
</section>
@endsection

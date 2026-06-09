@extends('layout.user')
@section('title', 'Lapaklama - Home')

@section('content')
<section class="hero-section">
    @if(Auth::check() && Auth::user()->jenis === 'penjual' && Auth::user()->status_penjual === 'pending')
        <div style="background-color: #fff3cd; color: #856404; padding: 15px; text-align: center; font-weight: bold; border-bottom: 1px solid #ffeeba;">
            <i class="bi bi-info-circle"></i> Akun Penjual Anda sedang menunggu persetujuan Admin. Sementara itu, Anda dapat menelusuri Lapaklama sebagai Pembeli.
        </div>
    @endif
    <div class="hero-container">
        <div class="hero-text">
            <h1>Lapaklama</h1>
            <h2>Lifestyle Rewear Products</h2>
            <p>
                Jual baju bekasmu atau ubah menjadi fashion baru melalui layanan daur ulang kami. 
                Temukan gaya unik sambil membantu mengurangi limbah fashion dunia.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('user.recyle-user') }}" class="btn btn-primary">Mulai Sekarang</a>
                <a href="{{ route('user.buy-user') }}" class="btn btn-outline">Lihat Produk</a>
            </div>
        </div>

        <div class="hero-gallery">
            <div class="diamond"><img src="https://i.pinimg.com/1200x/fb/39/79/fb3979109e3949abb68bc0afe510ce45.jpg" alt="Fashion 1"></div>
            <div class="diamond"><img src="https://i.pinimg.com/1200x/e2/5b/1a/e25b1aea77995078a6afaca5285dccad.jpg" alt="Fashion 2"></div>
            <div class="diamond"><img src="https://i.pinimg.com/1200x/fb/39/79/fb3979109e3949abb68bc0afe510ce45.jpg" alt="Fashion 3"></div>
            <div class="diamond"><img src="https://i.pinimg.com/1200x/e2/5b/1a/e25b1aea77995078a6afaca5285dccad.jpg" alt="Fashion 4"></div>
        </div>
    </div>
</section>

<section class="search-section">
    <div class="search-content">
        <h2>Lapaklama Fashion Centre</h2>
        <p>Cari baju bekas original atau ide daur ulang fashion favoritmu</p>
        <div class="search-box">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Cari jaket vintage, kaos oversize, dll..." id="searchInput">
            <button class="search-btn">Cari</button>
        </div>
    </div>
</section>

<section class="product-section">
    <div class="section-header">
        <h2 class="section-title">Produk Terbaru</h2>
        <a href="{{ route('user.buy-user') }}" class="see-more">Lihat Semua &rarr;</a>
    </div>

    <div class="slider-wrapper">
        <button class="slider-nav left">&#10094;</button>
        
        <div class="product-slider">
            @forelse($products as $product)
                <div class="product-card">
                    <div class="card-img">
                        <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->deskripsi }}" onerror="this.src='https://i.pinimg.com/webp/1200x/42/8d/fb/428dfb1e3d23fa5b022393a7c46199ac.webp'">
                        <div class="prod-overlay">
                            <a href="{{ route('user.view-product', $product->id) }}" class="btn btn-primary" style="padding: 8px 16px; font-size: 0.8rem;">Lihat Detail</a>
                        </div>
                    </div>
                    <div class="card-info">
                        <span class="prod-category">{{ $product->kategori ?? 'Produk' }}</span>
                        <h3>{{ $product->nama }}</h3>
                        <p class="prod-desc">{{ Str::limit($product->deskripsi, 80) }}</p>
                        <p class="price">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                    </div>
                </div>
            @empty
                <p style="grid-column: 1 / -1; text-align: center; padding: 40px;">Belum ada produk tersedia.</p>
            @endforelse
        </div>

        <button class="slider-nav right">&#10095;</button>
    </div>
</section>

<section class="recycle-section">
    <div class="section-header">
        <div>
            <h2 class="section-title">Discover Recycle Collection</h2>
            <p class="subtitle">Baju lama yang disulap menjadi fashion baru bernilai tinggi</p>
        </div>
        <a href="#" class="see-more">Eksplorasi &rarr;</a>
    </div>

    <div class="slider-wrapper">
        <button class="slider-nav left">&#10094;</button>
        
        <div class="recycle-slider">
            <div class="recycle-card">
                <div class="recycle-img-box">
                    <img src="https://i.pinimg.com/736x/b1/eb/82/b1eb8227368bd1153138d7bb84cba72c.jpg" alt="Totebag Denim">
                </div>
                <div class="recycle-info">
                    <span class="recycle-tag">Celana Jeans Lama</span>
                    <h3>Eco Totebag Denim</h3>
                    <p>Tas jinjing kuat dan stylish yang dibuat dari 100% potongan celana jeans bekas layak pakai.</p>
                </div>
            </div>

            <div class="recycle-card">
                <div class="recycle-img-box">
                    <img src="https://i.pinimg.com/736x/64/7e/a3/647ea37f4c9dc12d0523ac88b962aadf.jpg" alt="Kemeja Patchwork">
                </div>
                <div class="recycle-info">
                    <span class="recycle-tag">Kaos & Kemeja</span>
                    <h3>Jaket Bomber Patchwork</h3>
                    <p>Perpaduan estetik dari berbagai motif kemeja flanel bekas menjadi jaket bomber yang unik.</p>
                </div>
            </div>

            <div class="recycle-card">
                <div class="recycle-img-box">
                    <img src="https://i.pinimg.com/736x/9b/fb/83/9bfb8393ef9f6f7d931b1921d2712e33.jpg" alt="Pouch Aksesoris">
                </div>
                <div class="recycle-info">
                    <span class="recycle-tag">Kain Perca</span>
                    <h3>Utility Pouch Set</h3>
                    <p>Dompet kecil serbaguna untuk menyimpan make-up atau gadget, hasil daur ulang sisa potongan kain.</p>
                </div>
            </div>

            <div class="recycle-card">
                <div class="recycle-img-box">
                    <img src="https://i.pinimg.com/736x/d1/f4/f5/d1f4f5cd382c92666c421fbff76ee573.jpg" alt="Bucket Hat">
                </div>
                <div class="recycle-info">
                    <span class="recycle-tag">Bahan Campuran</span>
                    <h3>Reversible Bucket Hat</h3>
                    <p>Topi dua sisi yang trendi, dibuat dari sisa bahan denim dan korduroi untuk gaya kasualmu.</p>
                </div>
            </div>
        </div>

        <button class="slider-nav right">&#10095;</button>
    </div>
</section>

<section class="action-section">
    <h2 class="action-title">Ayo Coba Lapaklama Sekarang!</h2>
    <div class="action-grid">
        <div class="action-card">
            <div class="icon-box">🛍️</div>
            <h3>Beli Baju Berkualitas</h3>
            <p>Temukan baju bekas kualitas premium dengan harga terjangkau. Cari, pilih, dan beli dengan mudah!</p>
            <a href="{{ route('user.buy-user') }}" class="btn btn-primary btn-full">Belanja Sekarang</a>
        </div>
        
        <div class="action-card">
            <div class="icon-box">✂️</div>
            <h3>Ubah Baju Lamamu</h3>
            <p>Lapaklama membantu mengubah baju lamamu jadi lebih bernilai dengan sentuhan *upcycle* dari kreator kami.</p>
            <a href="{{ route('user.recyle-user') }}" class="btn btn-outline btn-full">Mulai Recycle</a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // 1. Script untuk Slider Produk Terbaru
        const productSlider = document.querySelector('.product-slider');
        const prodBtnLeft = document.querySelector('.product-section .slider-nav.left');
        const prodBtnRight = document.querySelector('.product-section .slider-nav.right');

        if (productSlider && prodBtnLeft && prodBtnRight) {
            prodBtnLeft.addEventListener('click', () => {
                productSlider.scrollBy({ left: -300, behavior: 'smooth' });
            });
            prodBtnRight.addEventListener('click', () => {
                productSlider.scrollBy({ left: 300, behavior: 'smooth' });
            });
        }

        // 2. Script untuk Slider Recycle Collection
        const recycleSlider = document.querySelector('.recycle-slider');
        const recBtnLeft = document.querySelector('.recycle-section .slider-nav.left');
        const recBtnRight = document.querySelector('.recycle-section .slider-nav.right');

        if (recycleSlider && recBtnLeft && recBtnRight) {
            recBtnLeft.addEventListener('click', () => {
                recycleSlider.scrollBy({ left: -300, behavior: 'smooth' });
            });
            recBtnRight.addEventListener('click', () => {
                recycleSlider.scrollBy({ left: 300, behavior: 'smooth' });
            });
        }
        
    });
</script>
@endsection
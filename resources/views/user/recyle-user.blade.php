@extends('layout.user')
@section('title','Daur Ulang')
@section('content')
<link rel="stylesheet" href="{{ asset('css/daurulang.css') }}">
<div class="recycle-page">
    
   <header class="recycle-hero">
    <div class="recycle-container">
        <!-- Tambahan Badge Baru -->
        <span class="hero-badge">🌱 Kampanye Ramah Lingkungan</span>
        
        <h1>Lapak Lama Daur Ulang</h1>
        <p>Ubah pakaian lama yang menumpuk di lemari menjadi karya baru yang bernilai tinggi dan ramah lingkungan.</p>
    </div>
    </header>
    
    <div class="recycle-container">
        
        <section class="catalog-section">
            <h2 class="section-title">Katalog Kreasi Daur Ulang</h2>
            
            <div class="catalog-grid">
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1544816155-12df9643f363?q=80&w=500" alt="Totebag Denim" class="product-image">
                    <div class="product-info">
                        <span class="product-tag">Celana Jeans Lama</span>
                        <h3 class="product-title">Eco Totebag Denim</h3>
                        <p class="product-desc">Tas jinjing kuat dan stylish yang dibuat dari 100% potongan celana jeans bekas layak pakai.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1596755094514-f87e34085b2c?q=80&w=500" alt="Jaket Patchwork" class="product-image">
                    <div class="product-info">
                        <span class="product-tag">Kaos & Kemeja</span>
                        <h3 class="product-title">Jaket Bomber Patchwork</h3>
                        <p class="product-desc">Perpaduan estetik dari berbagai motif kemeja flanel bekas menjadi jaket bomber yang unik.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1529139574466-a303027c1d8b?q=80&w=500" alt="Pouch Aksesoris" class="product-image">
                    <div class="product-info">
                        <span class="product-tag">Kain Perca</span>
                        <h3 class="product-title">Utility Pouch Set</h3>
                        <p class="product-desc">Dompet kecil serbaguna untuk menyimpan make-up atau gadget, hasil daur ulang sisa potongan kain.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <div class="cta-recycle-box">
                <h2>Punya Baju Bekas yang Menumpuk?</h2>
                <p>Jangan dibuang! Kirimkan pakaian lamamu ke Lapak Lama, tim desainer kami akan menyulapnya menjadi barang baru yang berguna sesuai keinginanmu.</p>
                
                <a href="{{ route('user.user-form') }}" class="btn-recycle">
                    Mulai Daur Ulang Bajuku Sekarang
                </a>
            </div>
        </section>

    </div>
</div>
@endsection
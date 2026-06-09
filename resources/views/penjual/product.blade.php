@extends('layout.web')
@section('title', 'Daftar Produk Saya')
@section('content')
<link rel="stylesheet" href="{{ asset('css/seller-product.css') }}">

<div class="product-dashboard">
    
    <div class="dashboard-header">
        <h1>Daftar Produk Saya</h1>
        {{-- Tombol opsional untuk tambah produk baru --}}
        <a href="{{ route('jual') }}" class="btn-add">+ Tambah Produk</a>
    </div>

    {{-- Pesan Sukses jika ada (setelah edit/hapus) --}}
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="product-grid">
        {{-- Looping data produk dari controller --}}
        @forelse ($products as $product)
            <div class="product-card">
                {{-- Gambar Produk --}}
                <img src="{{ asset('storage/' . $product->gambar) }}" alt="Produk" class="product-image" onerror="this.src='https://via.placeholder.com/250x200?text=No+Image'">
                
                <div class="product-info">
                    <h3 class="product-title">{{ $product->nama }}</h3>
                    <div class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                    <div class="product-stats">Kategori: {{ $product->kategori ?? 'Umum' }}</div>
                    <div class="product-stats">Status: {{ $product->status === 'tersedia' ? 'Tersedia' : 'Terjual' }}</div>
                </div>

                <div class="product-actions">
                    {{-- Tombol Edit --}}
                    <a href="{{ route('penjual.edit-product', $product->id) }}" class="btn-action btn-edit">Edit</a>
                    
                    {{-- Tombol Hapus (Harus menggunakan Form agar metodenya DELETE) --}}
                    <form action="{{ route('penjual.destroy-product', $product->id) }}" method="POST" class="form-delete" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action btn-delete">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 50px; color: #6c757d;">
                Belum ada produk yang dijual. Silakan tambah produk baru.
            </div>
        @endforelse
    </div>

</div>
@endsection
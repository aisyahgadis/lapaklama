@extends('layout.web')

@section('title','Jual Baju')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jual.css') }}">

<section class="jual-container">
    <h1>Jual Baju Bekasmu</h1>
    <p>Upload baju yang ingin kamu jual dan temukan pembeli dengan mudah.</p>

    <form class="jual-form" action="{{ route('penjual.product') }}" method="POST" enctype="multipart/form-data">
        @csrf <div class="form-group">
            <label>Foto Produk</label>
            <input type="file" name="gambar" id="imageUpload" accept="image/*" required>
            
            <div class="preview-container">
                <button type="button" class="slide-btn left" onclick="slideLeft()">❮</button>
                <div class="image-preview" id="imagePreview"></div>
                <button type="button" class="slide-btn right" onclick="slideRight()">❯</button>
            </div>
        </div>

        <div class="form-group">
            <label>Harga (Rp)</label>
            <input 
                type="number"
                id="harga"
                name="harga" 
                placeholder="Contoh: 10000"
                min="0"
                step="1000"
                oninput="formatHarga()"
                required
            >
        </div>

        <div class="form-group">
            <label>Deskripsi Produk</label>
            <textarea name="deskripsi" rows="4" placeholder="Ceritakan kondisi dan detail baju..." required></textarea>
        </div>

        <button type="submit" class="jual-btn">Jual Sekarang</button>
    </form>
</section>
@endsection
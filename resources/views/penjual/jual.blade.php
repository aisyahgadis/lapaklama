@extends('layout.web')

@section('title','Jual Baju')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jual.css') }}">

<section class="jual-container">
    <h1>Jual Baju Bekasmu</h1>
    <p>Upload baju yang ingin kamu jual dan temukan pembeli dengan mudah.</p>

    <form class="jual-form" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
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
            <label>Nama Produk</label>
            <input type="text" name="nama" placeholder="Contoh: Jaket Denim Vintage" required>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" required>
                <option value="">Pilih Kategori</option>
                <option value="jaket">Jaket</option>
                <option value="kemeja">Kemeja</option>
                <option value="kaos">Kaos</option>
                <option value="celana">Celana</option>
                <option value="dress">Dress</option>
            </select>
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
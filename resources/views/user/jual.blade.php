@extends('layout.web')

@section('title','Jual Baju')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jual.css') }}">

<section class="jual-container">

    <h1>Jual Baju Bekasmu</h1>
    <p>Upload baju yang ingin kamu jual dan temukan pembeli dengan mudah.</p>

    <form class="jual-form">

        <!-- Upload Foto -->
        <div class="form-group">
            <label>Foto Produk</label>

            <input type="file" id="imageUpload" multiple accept="image/*">

            <div class="preview-container">

            <button type="button" class="slide-btn left" onclick="slideLeft()">❮</button>

            <div class="image-preview" id="imagePreview"></div>

            <button type="button" class="slide-btn right" onclick="slideRight()">❯</button>

        </div>

        <!-- Nama Produk -->
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" placeholder="Contoh: Jaket Denim Vintage">
        </div>

        <!-- Merek -->
        <div class="form-group">
            <label>Merek</label>
            <input type="text" placeholder="Contoh: Levi's">
        </div>
        
        <!-- Kategori -->
        <div class="form-group">
            <label>Kategori</label>

            <select>
                <option>Jaket</option>
                <option>Kemeja</option>
                <option>Kaos</option>
                <option>Dress</option>
                <option>Celana</option>
            </select>

        </div>

        <!-- Harga -->
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
        <!-- Kondisi -->
        <div class="form-group">
            <label>Kondisi</label>

            <select>
                <option>Seperti Baru</option>
                <option>Sangat Baik</option>
                <option>Baik</option>
                <option>Cukup</option>
            </select>

        </div>

        <!-- Deskripsi -->
        <div class="form-group">
            <label>Deskripsi Produk</label>

            <textarea rows="4" placeholder="Ceritakan kondisi dan detail baju..."></textarea>

        </div>

        <button class="jual-btn">Jual Sekarang</button>

    </form>

</section>

@endsection
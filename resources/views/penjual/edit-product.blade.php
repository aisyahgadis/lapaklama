@extends('layout.web')
@section('title', 'Edit Produk')
@section('content')
<link rel="stylesheet" href="{{ asset('css/seller-edit-product.css') }}">

<div class="edit-dashboard">
    
    <div class="dashboard-header">
        <h1>Edit Produk</h1>
        <a href="{{ route('penjual.product') }}" class="btn-back">Kembali</a>
    </div>

    <div class="form-card">
        <form action="{{ route('penjual.update-product', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama Produk</label>
                <input type="text" id="nama" name="nama" class="form-control" value="{{ $product->nama }}" required>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    <option value="jaket" {{ $product->kategori == 'jaket' ? 'selected' : '' }}>Jaket</option>
                    <option value="kemeja" {{ $product->kategori == 'kemeja' ? 'selected' : '' }}>Kemeja</option>
                    <option value="kaos" {{ $product->kategori == 'kaos' ? 'selected' : '' }}>Kaos</option>
                    <option value="celana" {{ $product->kategori == 'celana' ? 'selected' : '' }}>Celana</option>
                    <option value="dress" {{ $product->kategori == 'dress' ? 'selected' : '' }}>Dress</option>
                </select>
            </div>

            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input type="number" id="harga" name="harga" class="form-control" value="{{ $product->harga }}" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Produk</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control" required>{{ $product->deskripsi }}</textarea>
            </div>

            <div class="form-group">
                <label for="gambar">Ganti Foto Produk (Opsional)</label>
                <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*">
                
                <div class="image-preview-container">
                    <p style="font-size: 0.85rem; color: #666; margin-bottom: 5px;">Foto saat ini:</p>
                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="Preview" class="image-preview">
                </div>
            </div>

            <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </form>
    </div>

</div>
@endsection
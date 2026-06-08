@extends('layout.web')
@section('title', 'Edit Produk')
@section('content')
<link rel="stylesheet" href="{{ asset('css/seller-edit-product.css') }}">

{{-- Membuat Dummy Data langsung di Blade --}}
@php
    $dummyProduct = (object)[
        'id' => 1,
        'name' => 'Sepatu Sneakers Pria',
        'price' => 250000,
        'description' => 'Sepatu sneakers pria kualitas premium, nyaman dipakai untuk sehari-hari maupun olahraga ringan. Tersedia dalam ukuran 40-44.',
        'image' => 'https://via.placeholder.com/250x200/eee/333?text=Sepatu+Sneakers'
    ];
@endphp

<div class="edit-dashboard">
    
    <div class="dashboard-header">
        <h1>Edit Produk</h1>
        <a href="#" class="btn-back" onclick="alert('Kembali ke halaman daftar produk')">Kembali</a>
    </div>

    <div class="form-card">
        {{-- Panggil fungsi JS showNotification() saat tombol submit ditekan --}}
        <form action="#" onsubmit="showNotification(event)">
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $dummyProduct->name }}" required>
            </div>

            <div class="form-group">
                <label for="price">Harga (Rp)</label>
                <input type="number" id="price" name="price" class="form-control" value="{{ $dummyProduct->price }}" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Produk</label>
                <textarea id="description" name="description" class="form-control" required>{{ $dummyProduct->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Ganti Foto Produk (Opsional)</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                
                <div class="image-preview-container">
                    <p style="font-size: 0.85rem; color: #666; margin-bottom: 5px;">Foto saat ini:</p>
                    <img src="{{ $dummyProduct->image }}" alt="Preview" class="image-preview">
                </div>
            </div>

            <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </form>
    </div>

</div>

{{-- Elemen Notifikasi --}}
<div id="success-toast" class="toast-notification">
    Data produk berhasil disimpan!
</div>

{{-- Script JavaScript untuk memunculkan notifikasi --}}
<script>
    function showNotification(event) {
        // Mencegah form melakukan refresh halaman (karena masih dummy)
        event.preventDefault(); 

        // Ambil elemen toast berdasarkan ID
        var toast = document.getElementById("success-toast");

        // Tambahkan class 'show' agar CSS animasinya berjalan dan notif muncul
        toast.classList.add("show");

        // Sembunyikan kembali notifikasi setelah 3 detik (3000 milidetik)
        setTimeout(function(){ 
            toast.classList.remove("show"); 
        }, 3000);
    }
</script>

@endsection
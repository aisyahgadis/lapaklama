@extends('layout.CRUD')
@section('title','Detail Daur Ulang')
@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-recycle.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="admin-page">
    
    <div class="admin-header">
        <h1><i class="bi bi-scissors me-2"></i> Penugasan Penjahit Daur Ulang</h1>
        <p class="text-muted">ID Order: #RCY-202605-001</p>
    </div>

    <div class="admin-split-layout">
        
        <div class="admin-card">
            <h2 class="card-title">Detail Pakaian & Permintaan User</h2>
            
            <img src="https://images.unsplash.com/photo-1544816155-12df9643f363?q=80&w=500" alt="Baju User" class="user-request-img">
            
            <div class="info-label">Nama Pengirim</div>
            <div class="info-value">Ahmad Junaedi</div>

            <div class="info-label">Deskripsi Permintaan Daur Ulang</div>
            <div class="info-value">
                "Saya punya celana jeans bekas yang robek di lutut. Saya ingin mendaur ulangnya menjadi tas totebag kecil yang bisa dipakai kuliah, kalau bisa sisakan saku belakang jeans-nya ya..."
            </div>
        </div>

        <div class="admin-card">
            <h2 class="card-title">Rekomendasi Penjahit Spesialis</h2>
            
            <div class="tailor-list">
                <div class="tailor-item">
                    <div class="tailor-info">
                        <h4>Pak Joko Setiawan</h4>
                        <span class="tailor-badge">Spesialis Denim & Jeans</span>
                        <div class="tailor-status"><i class="bi bi-briefcase-fill me-1"></i> Sedang mengerjakan 2 project</div>
                    </div>
                    <form action="#" method="POST">
                        @csrf
                        <input type="hidden" name="tailor_id" value="1">
                        <button type="submit" class="btn-assign">Pilih</button>
                    </form>
                </div>

                <div class="tailor-item">
                    <div class="tailor-info">
                        <h4>Ibu Sri Wahyuni</h4>
                        <span class="tailor-badge">Spesialis Kemeja & Kain Perca</span>
                        <div class="tailor-status"><i class="bi bi-briefcase-fill me-1"></i> Sedang mengerjakan 0 project (Sangat Tersedia)</div>
                    </div>
                    <form action="#" method="POST">
                        @csrf
                        <input type="hidden" name="tailor_id" value="2">
                        <button type="submit" class="btn-assign">Pilih</button>
                    </form>
                </div>

                <div class="tailor-item">
                    <div class="tailor-info">
                        <h4>Mbak Amalia</h4>
                        <span class="tailor-badge">Spesialis Kaos & Rajut</span>
                        <div class="tailor-status"><i class="bi bi-briefcase-fill me-1"></i> Sedang mengerjakan 1 project</div>
                    </div>
                    <form action="#" method="POST">
                        @csrf
                        <input type="hidden" name="tailor_id" value="3">
                        <button type="submit" class="btn-assign">Pilih</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
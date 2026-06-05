@extends('layout.admin')

@section('title','dashboard')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<div class="dashboard-container">
    
    <div class="dashboard-header">
        <div class="header-titles">
            <h1>Dashboard Overview</h1>
            <p>Pantau aktivitas daur ulang dan pendaftaran penjual hari ini.</p>
        </div>
        <button class="btn-primary">+ Tambah Penjahit Baru</button>
    </div>

    <div class="stat-cards">
        <div class="card">
            <div class="card-info">
                <h3>Penjual Menunggu</h3>
                <p class="stat-number color-orange">8</p>
            </div>
            <div class="card-icon bg-orange">WA</div>
        </div>

        <div class="card">
            <div class="card-info">
                <h3>Menunggu Penjahit</h3>
                <p class="stat-number color-red">15</p>
            </div>
            <div class="card-icon bg-red">PR</div>
        </div>

        <div class="card">
            <div class="card-info">
                <h3>Penjahit Aktif</h3>
                <p class="stat-number color-teal">24</p>
            </div>
            <div class="card-icon bg-teal">AC</div>
        </div>

        <div class="card">
            <div class="card-info">
                <h3>Total Produk</h3>
                <p class="stat-number color-blue">342</p>
            </div>
            <div class="card-icon bg-blue">TO</div>
        </div>
    </div>

    <div class="dashboard-tables">
        
        <div class="table-panel">
            <div class="panel-header">
                <h3>Permintaan Buka Toko Terbaru</h3>
                <a href="#" class="link-teal">Lihat Semua</a>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-item">
                        <div class="item-info">
                            <h4>Kreasi Karung Goni</h4>
                            <p>Daftar: Hari ini, 09:30 WIB</p>
                        </div>
                        <span class="badge badge-warning">Pending</span>
                    </li>
                    <li class="list-item">
                        <div class="item-info">
                            <h4>Limbah Kayu Art</h4>
                            <p>Daftar: Kemarin, 15:20 WIB</p>
                        </div>
                        <span class="badge badge-warning">Pending</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="table-panel">
            <div class="panel-header">
                <h3>Antrean Produksi (Butuh Penjahit)</h3>
                <a href="#" class="link-teal">Kelola Penjahit</a>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-item">
                        <div class="item-info">
                            <h4>#PRD-001 (Totebag Jeans)</h4>
                            <p>Bahan: 5kg Celana Jeans Bekas</p>
                        </div>
                        <button class="btn-secondary">Pilih Penjahit</button>
                    </li>
                    <li class="list-item">
                        <div class="item-info">
                            <h4>#PRD-002 (Dompet Spanduk)</h4>
                            <p>Bahan: 10 Lembar Spanduk</p>
                        </div>
                        <button class="btn-secondary">Pilih Penjahit</button>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection
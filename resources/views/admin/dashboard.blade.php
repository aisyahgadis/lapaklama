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
        <a href="#" class="btn-primary" style="text-decoration: none;">+ Tambah Penjahit Baru</a>
    </div>

    <div class="stat-cards">
        <div class="card">
            <div class="card-info">
                <h3>Penjual Menunggu</h3>
                <p class="stat-number color-orange">{{ $penjualMenunggu }}</p>
            </div>
            <div class="card-icon bg-orange">WA</div>
        </div>

        <div class="card">
            <div class="card-info">
                <h3>Menunggu Penjahit</h3>
                <p class="stat-number color-red">{{ $menungguPenjahit }}</p>
            </div>
            <div class="card-icon bg-red">PR</div>
        </div>

        <div class="card">
            <div class="card-info">
                <h3>Penjahit Aktif</h3>
                <p class="stat-number color-teal">{{ $penjahitAktif }}</p>
            </div>
            <div class="card-icon bg-teal">AC</div>
        </div>

        <div class="card">
            <div class="card-info">
                <h3>Total Produk</h3>
                <p class="stat-number color-blue">{{ $totalProduk }}</p>
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
                    @forelse($permintaanToko as $toko)
                    <li class="list-item">
                        <div class="item-info">
                            <h4>{{ $toko->name }}</h4> 
                            <p>Daftar: {{ $toko->created_at->translatedFormat('l, d M Y, H:i') }} WIB</p>
                        </div>
                        <span class="badge badge-warning">Pending</span>
                    </li>
                    @empty
                    <li class="list-item">
                        <div class="item-info">
                            <p>Tidak ada permintaan buka toko saat ini.</p>
                        </div>
                    </li>
                    @endforelse
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
                    @forelse($antreanProduksi as $produksi)
                    <li class="list-item">
                        <div class="item-info">
                            <h4>#{{ $produksi->product_code }} ({{ $produksi->product_name }})</h4>
                            <p>Bahan: {{ $produksi->material_description }}</p>
                        </div>
                        <button class="btn-secondary">Pilih Penjahit</button>
                    </li>
                    @empty
                    <li class="list-item">
                        <div class="item-info">
                            <p>Tidak ada antrean produksi saat ini.</p>
                        </div>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection
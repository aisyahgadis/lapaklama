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
        <a href="{{ route('admin.user') }}" class="btn-primary" style="text-decoration: none;">+ Kelola User</a>
    </div>

    <div class="stat-cards">
        <div class="card" style="cursor: pointer;" onclick="window.location='{{ route('admin.persetujuan') }}'">
            <div class="card-info">
                <h3>Penjual Menunggu</h3>
                <p class="stat-number color-orange">{{ $penjualMenunggu }}</p>
            </div>
            <div class="card-icon bg-orange"><i class="bi bi-shop"></i></div>
        </div>

        <div class="card" style="cursor: pointer;" onclick="window.location='{{ route('admin.recycle-detail') }}'">
            <div class="card-info">
                <h3>Menunggu Penjahit</h3>
                <p class="stat-number color-red">{{ $menungguPenjahit }}</p>
            </div>
            <div class="card-icon bg-red"><i class="bi bi-recycle"></i></div>
        </div>

        <div class="card" style="cursor: pointer;" onclick="window.location='{{ route('admin.user') }}'">
            <div class="card-info">
                <h3>Penjahit Aktif</h3>
                <p class="stat-number color-teal">{{ $penjahitAktif }}</p>
            </div>
            <div class="card-icon bg-teal"><i class="bi bi-scissors"></i></div>
        </div>

        <div class="card" style="cursor: pointer;" onclick="window.location='{{ route('admin.product') }}'">
            <div class="card-info">
                <h3>Total Produk</h3>
                <p class="stat-number color-blue">{{ $totalProduk }}</p>
            </div>
            <div class="card-icon bg-blue"><i class="bi bi-bag"></i></div>
        </div>
    </div>

    <div class="dashboard-tables">
        
        <div class="table-panel">
            <div class="panel-header">
                <h3>Permintaan Buka Toko Terbaru</h3>
                <a href="{{ route('admin.persetujuan') }}" class="link-teal">Lihat Semua</a>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    @forelse($permintaanToko as $toko)
                    <li class="list-item">
                        <div class="item-info">
                            <h4>{{ $toko->nama }} ({{ $toko->nama_toko ?? 'Belum ada nama toko' }})</h4> 
                            <p>Daftar: {{ $toko->created_at->translatedFormat('l, d M Y, H:i') }} WIB</p>
                        </div>
                        <a href="{{ route('admin.persetujuan') }}" class="btn btn-secondary" style="text-decoration: none;">Kelola</a>
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
                <a href="{{ route('admin.recycle-detail') }}" class="link-teal">Kelola Penjahit</a>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    @forelse($antreanProduksi as $produksi)
                    <li class="list-item">
                        <div class="item-info">
                            <h4>Ide Daur Ulang (User: {{ $produksi->user->nama ?? 'Unknown' }})</h4>
                            <p>Deskripsi: {{ Str::limit($produksi->deskripsi, 50) }}</p>
                        </div>
                        <a href="{{ route('admin.recycle-detail') }}" class="btn btn-secondary" style="text-decoration: none;">Pilih Penjahit</a>
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
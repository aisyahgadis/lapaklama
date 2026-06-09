@extends('layout.web')
@section('title', 'Lapaklama - History')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    .pesanan-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        font-family: 'Inter', sans-serif;
    }
    .pesanan-title {
        font-size: 2rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 20px;
        border-bottom: 2px solid #27ae60;
        padding-bottom: 10px;
        display: inline-block;
    }
    .tab-container {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    .tab-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        background: #e9ecef;
        color: #555;
        transition: 0.3s;
    }
    .tab-btn.active {
        background: #27ae60;
        color: white;
    }
    .tab-content {
        display: none;
    }
    .tab-content.active {
        display: block;
    }
    .order-card, .recycle-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 20px;
        overflow: hidden;
        border: 1px solid #eee;
    }
    .order-header, .recycle-header {
        background: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .order-id, .recycle-id { font-weight: bold; color: #555; }
    .order-status, .recycle-status {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: bold;
        text-transform: uppercase;
    }
    .status-menunggu, .status-menunggu_assign { background: #fff3cd; color: #856404; }
    .status-diproses, .status-assigned { background: #cce5ff; color: #004085; }
    .status-dikirim { background: #d4edda; color: #155724; }
    .status-selesai { background: #e2e3e5; color: #383d41; }
    
    .order-body, .recycle-body {
        padding: 20px;
        display: flex;
        gap: 20px;
    }
    .order-product-img, .recycle-product-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
    }
    .order-details, .recycle-details { flex: 1; }
    .order-details h4, .recycle-details h4 { margin: 0 0 10px 0; font-size: 1.2rem; }
    .order-info p, .recycle-info p { margin: 5px 0; color: #555; font-size: 0.95rem; }
    .order-info strong, .recycle-info strong { color: #333; }
    
    .order-actions, .recycle-actions {
        padding: 15px 20px;
        background: #fafafa;
        border-top: 1px solid #eee;
        text-align: right;
    }
    .btn {
        padding: 8px 16px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-weight: bold;
        transition: 0.3s;
    }
    .btn-accept, .btn-save { background: #27ae60; color: white; }
    .btn-accept:hover, .btn-save:hover { background: #219653; }
    .btn-ship { background: #2980b9; color: white; }
    .btn-ship:hover { background: #2471a3; }
    .resi-input, .alamat-textarea {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-right: 10px;
        width: 250px;
    }
</style>

<div class="pesanan-container">
    <h2 class="pesanan-title">History</h2>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="tab-container">
        <button class="tab-btn active" onclick="showTab('orders')">Pesanan Masuk</button>
        <button class="tab-btn" onclick="showTab('recycles')">Daur Ulang</button>
    </div>

    <!-- Pesanan Tab -->
    <div class="tab-content active" id="ordersTab">
        @forelse($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <span class="order-id">Order #{{ $order->id }} - {{ $order->created_at->format('d M Y, H:i') }}</span>
                    <span class="order-status status-{{ strtolower($order->status) }}">
                        {{ $order->status }}
                    </span>
                </div>
                
                <div class="order-body">
                    <img src="{{ asset('storage/' . $order->product->gambar) }}" class="order-product-img" alt="Produk">
                    <div class="order-details">
                        <h4>{{ $order->product->nama ?? $order->product->kategori }} - Rp {{ number_format($order->product->harga, 0, ',', '.') }}</h4>
                        <div class="order-info">
                            <p><strong>Pembeli:</strong> {{ $order->pembeli->name }}</p>
                            <p><strong>Penerima:</strong> {{ $order->nama_penerima }} ({{ $order->no_telp }})</p>
                            <p><strong>Alamat:</strong> {{ $order->alamat }}</p>
                            <p><strong>Metode Pembayaran:</strong> {{ strtoupper($order->metode_pembayaran) }}</p>
                            @if($order->bukti_bayar)
                                <p><strong>Bukti Pembayaran:</strong> <a href="{{ asset('storage/' . $order->bukti_bayar) }}" target="_blank" style="color: #2980b9;">Lihat Bukti</a></p>
                            @endif
                            @if($order->resi)
                                <p><strong>Resi Pengiriman:</strong> {{ $order->resi }}</p>
                            @endif
                        </div>
                    </div>
                    <div style="text-align: center; padding: 10px;">
                        <p style="font-size: 0.85rem; color: #555; margin-bottom: 5px;"><i class="bi bi-qr-code"></i> Scan untuk Detail</p>
                        <img src="https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl={{ urlencode('Order #'.$order->id.' | Status: '.$order->status.' | Produk: '.($order->product->nama ?? $order->product->kategori)) }}&choe=UTF-8" alt="QR Code">
                    </div>
                </div>

                <div class="order-actions">
                    @if($order->status == 'menunggu')
                        <form action="{{ route('penjual.orders.accept', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-accept" onclick="return confirm('Terima pesanan ini?')">
                                <i class="bi bi-check-circle"></i> Terima Pesanan
                            </button>
                        </form>
                    @elseif($order->status == 'diproses')
                        <form action="{{ route('penjual.orders.ship', $order->id) }}" method="POST" style="display:inline-flex; align-items:center;">
                            @csrf
                            <input type="text" name="resi" class="resi-input" placeholder="Masukkan Nomor Resi" required>
                            <button type="submit" class="btn btn-ship">
                                <i class="bi bi-truck"></i> Kirim Barang
                            </button>
                        </form>
                    @elseif($order->status == 'dikirim')
                        <span style="color: #555; font-style: italic;">Menunggu pembeli menerima barang.</span>
                    @elseif($order->status == 'selesai')
                        @if($order->rating)
                            <span style="color: #f1c40f;">
                                @for($i=1; $i<=5; $i++)
                                    <i class="bi bi-star{{ $i <= $order->rating ? '-fill' : '' }}"></i>
                                @endfor
                            </span>
                            <p style="margin: 5px 0 0 0; color: #555; font-style: italic;">"{{ $order->review }}"</p>
                        @else
                            <span style="color: #555; font-style: italic;">Pembeli belum memberikan rating.</span>
                        @endif
                    @endif
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 50px; background: white; border-radius: 12px; border: 1px solid #eee;">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                <h3 style="color: #555; margin-top: 10px;">Belum ada pesanan masuk</h3>
            </div>
        @endforelse
    </div>

    <!-- Recycle Tab -->
    <div class="tab-content" id="recyclesTab">
        @forelse($recycles as $recycle)
            <div class="order-card">
                <div class="order-header">
                    <span class="order-id">Daur Ulang - {{ $recycle->created_at->format('d M Y, H:i') }}</span>
                    <span class="order-status status-{{ str_replace(' ', '_', strtolower($recycle->status)) }}">
                        {{ $recycle->status }}
                    </span>
                </div>
                
                <div class="order-body">
                    <img src="{{ asset('storage/' . $recycle->gambar) }}" class="order-product-img" alt="Produk" onerror="this.src='https://via.placeholder.com/250x200?text=No+Image'">
                    <div class="order-details">
                        <h4>{{ $recycle->kategori ?? 'Custom' }}</h4>
                        <div class="order-info">
                            <p><strong>Deskripsi:</strong> {{ Str::limit($recycle->deskripsi, 100) }}</p>
                            @if($recycle->penjahit)
                                <p><strong>Penjahit:</strong> {{ $recycle->penjahit->nama ?? 'Penjahit' }}</p>
                                @if($recycle->penjahit->no_hp)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $recycle->penjahit->no_hp) }}" target="_blank" style="color: #25D366; text-decoration: underline; font-weight: bold;">
                                        <i class="bi bi-whatsapp"></i> Hubungi via WhatsApp
                                    </a>
                                @endif
                            @endif
                            @if($recycle->alamat_pengiriman)
                                <p><strong>Alamat Pengiriman:</strong> {{ $recycle->alamat_pengiriman }}</p>
                            @endif
                            @if($recycle->kode_resi)
                                <p style="padding: 10px; background: #e8f4fd; border-radius: 5px; border-left: 4px solid #3498db;">
                                    <strong>Nomor Resi:</strong> {{ $recycle->kode_resi }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div style="text-align: center; padding: 10px;">
                        <p style="font-size: 0.85rem; color: #555; margin-bottom: 5px;"><i class="bi bi-qr-code"></i> Scan untuk Detail</p>
                        <img src="https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl={{ urlencode('Daur Ulang | Status: '.$recycle->status.' | Kategori: '.($recycle->kategori ?? 'Custom')) }}&choe=UTF-8" alt="QR Code">
                    </div>
                </div>

                @if($recycle->penjahit)
                    <div class="order-actions">
                        @php
                            $isKirimSelesai = !empty($recycle->alamat_pengiriman) && !empty($recycle->kode_resi);
                        @endphp
                        @if($isKirimSelesai)
                            <span style="color: #555; font-style: italic;">
                                <i class="bi bi-check-circle" style="color: #27ae60;"></i> Alamat & Resi telah dikirim!
                            </span>
                        @else
                            <form action="{{ route('penjual.recycle.update-resi', $recycle->id) }}" method="POST" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                                @csrf
                                <textarea name="alamat_pengiriman" rows="2" class="resi-input" placeholder="Alamat Pengiriman" style="width:300px; resize:vertical; padding:8px; border:1px solid #ddd; border-radius:4px;">{{ $recycle->alamat_pengiriman }}</textarea>
                                <input type="text" name="kode_resi" class="resi-input" placeholder="Masukkan Nomor Resi" value="{{ $recycle->kode_resi }}">
                                <button type="submit" class="btn btn-accept">
                                    <i class="bi bi-save"></i> Simpan
                                </button>
                            </form>
                        @endif
                    </div>
                @else
                    <div class="order-actions">
                        <span style="color: #555; font-style: italic;">Menunggu admin memilih penjahit.</span>
                    </div>
                @endif
            </div>
        @empty
            <div style="text-align: center; padding: 50px; background: white; border-radius: 12px; border: 1px solid #eee;">
                <i class="bi bi-recycle" style="font-size: 3rem; color: #ccc;"></i>
                <h3 style="color: #555; margin-top: 10px;">Belum ada permintaan daur ulang</h3>
                <a href="{{ route('daurulang') }}" class="btn btn-accept" style="margin-top: 15px; display: inline-block;">Mulai Daur Ulang</a>
            </div>
        @endforelse
    </div>
</div>

<script>
    function showTab(tabName) {
        // Hide all tabs
        const tabs = document.querySelectorAll('.tab-content');
        tabs.forEach(tab => tab.classList.remove('active'));
        
        // Remove active class from all buttons
        const buttons = document.querySelectorAll('.tab-btn');
        buttons.forEach(btn => btn.classList.remove('active'));
        
        // Show selected tab
        document.getElementById(tabName + 'Tab').classList.add('active');
        
        // Add active class to selected button
        event.target.classList.add('active');
    }
</script>
@endsection

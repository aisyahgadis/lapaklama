@extends('layout.user')
@section('title', 'Lapaklama - History')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    .lacak-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        font-family: 'Inter', sans-serif;
    }
    .lacak-title {
        font-size: 2rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 20px;
        border-bottom: 2px solid #2980b9;
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
        background: #2980b9;
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
    .btn-receive, .btn-save { background: #27ae60; color: white; }
    .btn-receive:hover, .btn-save:hover { background: #219653; }
    .btn-review { background: #f39c12; color: white; }
    .btn-review:hover { background: #d68910; }

    /* Modal Review */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }
    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 90%;
        max-width: 500px;
        border-radius: 10px;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }
    .close:hover { color: black; }
    .rating-stars {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;
        margin: 15px 0;
    }
    .rating-stars input { display: none; }
    .rating-stars label {
        font-size: 30px;
        color: #ccc;
        cursor: pointer;
        padding: 0 5px;
        transition: color 0.2s;
    }
    .rating-stars input:checked ~ label,
    .rating-stars label:hover,
    .rating-stars label:hover ~ label {
        color: #f1c40f;
    }
    .review-textarea, .resi-input, .alamat-textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
        resize: vertical;
    }
</style>

<div class="lacak-container">
    <h2 class="lacak-title">History Anda</h2>

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
        <button class="tab-btn active" onclick="showTab('orders')">Pesanan</button>
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
                            <p><strong>Toko:</strong> {{ $order->product->penjual->nama ?? 'Penjual' }}</p>
                            <p><strong>Alamat Pengiriman:</strong> {{ $order->alamat }}</p>
                            @if($order->resi)
                                <p style="margin-top: 10px; padding: 10px; background: #e8f4fd; border-radius: 5px; border-left: 4px solid #3498db;">
                                    <strong>Nomor Resi:</strong> {{ $order->resi }}
                                </p>
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
                        <span style="color: #555; font-style: italic;">Menunggu penjual memproses pesanan Anda.</span>
                    @elseif($order->status == 'diproses')
                        <span style="color: #555; font-style: italic;">Penjual sedang menyiapkan barang Anda.</span>
                    @elseif($order->status == 'dikirim')
                        <form action="{{ route('user.orders.receive', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-receive" onclick="return confirm('Konfirmasi bahwa barang telah Anda terima dalam kondisi baik?')">
                                <i class="bi bi-box-seam"></i> Pesanan Diterima
                            </button>
                        </form>
                    @elseif($order->status == 'selesai')
                        @if($order->rating)
                            <span style="color: #f1c40f;">
                                @for($i=1; $i<=5; $i++)
                                    <i class="bi bi-star{{ $i <= $order->rating ? '-fill' : '' }}"></i>
                                @endfor
                            </span>
                            <p style="margin: 5px 0 0 0; color: #555; font-style: italic;">"{{ $order->review }}"</p>
                        @else
                            <button type="button" class="btn btn-review" onclick="openReviewModal({{ $order->id }})">
                                <i class="bi bi-star"></i> Beri Rating
                            </button>
                        @endif
                    @endif
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 50px; background: white; border-radius: 12px; border: 1px solid #eee;">
                <i class="bi bi-bag-x" style="font-size: 3rem; color: #ccc;"></i>
                <h3 style="color: #555; margin-top: 10px;">Anda belum memiliki pesanan</h3>
                <a href="{{ route('user.buy-user') }}" class="btn btn-receive" style="margin-top: 15px; display: inline-block;">Mulai Belanja</a>
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
                            <form action="{{ route('user.recycle.update-resi', $recycle->id) }}" method="POST" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                                @csrf
                                <textarea name="alamat_pengiriman" rows="2" class="resi-input" placeholder="Alamat Pengiriman" style="width:300px; resize:vertical; padding:8px; border:1px solid #ddd; border-radius:4px;">{{ $recycle->alamat_pengiriman }}</textarea>
                                <input type="text" name="kode_resi" class="resi-input" placeholder="Masukkan Nomor Resi" value="{{ $recycle->kode_resi }}">
                                <button type="submit" class="btn btn-receive">
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
                <h3 style="color: #555; margin-top: 10px;">Anda belum memiliki permintaan daur ulang</h3>
                <a href="{{ route('user.recyle-user') }}" class="btn btn-receive" style="margin-top: 15px; display: inline-block;">Mulai Daur Ulang</a>
            </div>
        @endforelse
    </div>
</div>

<!-- Modal Rating -->
<div id="reviewModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeReviewModal()">&times;</span>
        <h3 style="margin-top: 0;">Beri Rating & Ulasan</h3>
        <form id="reviewForm" action="" method="POST">
            @csrf
            <div class="rating-stars">
                <input type="radio" id="star5" name="rating" value="5" required />
                <label for="star5"><i class="bi bi-star-fill"></i></label>
                <input type="radio" id="star4" name="rating" value="4" />
                <label for="star4"><i class="bi bi-star-fill"></i></label>
                <input type="radio" id="star3" name="rating" value="3" />
                <label for="star3"><i class="bi bi-star-fill"></i></label>
                <input type="radio" id="star2" name="rating" value="2" />
                <label for="star2"><i class="bi bi-star-fill"></i></label>
                <input type="radio" id="star1" name="rating" value="1" />
                <label for="star1"><i class="bi bi-star-fill"></i></label>
            </div>
            
            <textarea name="review" rows="4" class="review-textarea" placeholder="Bagaimana kualitas produk ini? Ceritakan pengalaman Anda..."></textarea>
            
            <button type="submit" class="btn btn-review" style="width: 100%;">Kirim Ulasan</button>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('reviewModal');
    const form = document.getElementById('reviewForm');
    
    function openReviewModal(orderId) {
        form.action = `/user/orders/${orderId}/review`;
        modal.style.display = 'block';
    }
    
    function closeReviewModal() {
        modal.style.display = 'none';
    }
    
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
    
    window.onclick = function(event) {
        if (event.target == modal) {
            closeReviewModal();
        }
    }
</script>
@endsection

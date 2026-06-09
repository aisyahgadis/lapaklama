@extends('layout.user')

@section('content')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

<form action="{{ route('user.checkout.process', $product->id) }}" method="POST" style="display: contents;">
    @csrf <div class="checkout-container">
        
        <div class="checkout-form">
            <div class="section-title">Alamat Pengiriman</div>
            <div class="form-group">
                <label>Nama Penerima</label>
                <input type="text" name="nama_penerima" class="form-control" value="{{ Auth::check() ? Auth::user()->name : '' }}" placeholder="Nama Lengkap" required>
            </div>
            <div class="form-group">
                <label>Nomor Telepon/WhatsApp</label>
                <input type="text" name="no_telp" class="form-control" placeholder="Contoh: 08123xxx" required>
            </div>
            <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea name="alamat" rows="3" class="form-control" placeholder="Nama jalan, nomor rumah, RT/RW, Kecamatan, Kota, Kode Pos" required></textarea>
            </div>

            <div class="section-title">Metode Pembayaran</div>
            <div class="form-group">
                <label>Pilih Pembayaran</label>
                <select name="metode_pembayaran" class="form-control" required>
                    <option value="gopay">GoPay / QRIS</option>
                    <option value="bca">Transfer Bank BCA (Virtual Account)</option>
                    <option value="mandiri">Transfer Bank Mandiri</option>
                    <option value="cod">Bayar di Tempat (COD)</option>
                </select>
            </div>
        </div>

        <div class="checkout-summary">
            <div class="section-title">Ringkasan Order</div>
            
            <div class="product-item">
                <img src="{{ asset('storage/' . $product->gambar) }}" alt="Produk" style="width: 80px; height: 90px; object-fit: cover;">
                <div class="product-info">
                    <h4>Produk Fashion #{{ $product->id }}</h4>
                    <p>1 pcs</p>
                    <p>Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                </div>
            </div>

            @php
                $ongkir = 15000; // Contoh ongkir statis, bisa kamu ubah nanti
                $total = $product->harga + $ongkir;
            @endphp

            <div class="total-row">
                <span>Subtotal Produk</span>
                <span>Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
            </div>
            <div class="total-row">
                <span>Biaya Pengiriman</span>
                <span>Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
            </div>
            
            <div class="total-row grand-total">
                <span>Total Pembayaran</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            <button type="submit" class="btn-checkout" onclick="return confirm('Apakah kamu yakin ingin memproses pembayaran ini? Barang akan otomatis ditandai sebagai terjual.')">
                Proses Pembayaran
            </button>
        </div>
        
    </div>
</form>
@endsection
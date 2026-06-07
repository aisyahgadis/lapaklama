@extends('layout.user')

@section('content')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

<div class="checkout-container">
    <div class="checkout-form">
        <form action="{{ route('user.payment') }}" method="POST">
            
            <div class="section-title">Alamat Pengiriman</div>
            <div class="form-group">
                <label>Nama Penerima</label>
                <input type="text" class="form-control" value="Budi Santoso" placeholder="Nama Lengkap">
            </div>
            <div class="form-group">
                <label>Nomor Telepon/WhatsApp</label>
                <input type="text" class="form-control" value="081234567890" placeholder="Contoh: 08123xxx">
            </div>
            <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea rows="3" placeholder="Nama jalan, nomor rumah, RT/RW, Kecamatan, Kota, Kode Pos">Jl. Anggrek No. 12, RT 03/RW 04, Meruya Utara, Kembangan, Jakarta Barat, 11620</textarea>
            </div>

            <div class="section-title">Metode Pembayaran</div>
            <div class="form-group">
                <label>Pilih Pembayaran</label>
                <select>
                    <option value="gopay">GoPay / QRIS</option>
                    <option value="bca">Transfer Bank BCA (Virtual Account)</option>
                    <option value="mandiri">Transfer Bank Mandiri</option>
                    <option value="cod">Bayar di Tempat (COD)</option>
                </select>
            </div>

        </form>
    </div>

    <div class="checkout-summary">
        <div class="section-title">Ringkasan Order</div>
        
        <div class="product-item">
            <img src="https://via.placeholder.com/80x90?text=Baju" alt="Produk">
            <div class="product-info">
                <h4>Kemeja Flanel Kotak-Kotak</h4>
                <p>Ukuran: L</p>
                <p>1 pcs x Rp 150.000</p>
            </div>
        </div>

        <div class="total-row">
            <span>Subtotal Produk</span>
            <span>Rp 150.000</span>
        </div>
        <div class="total-row">
            <span>Biaya Pengiriman</span>
            <span>Rp 15.000</span>
        </div>
        
        <div class="total-row grand-total">
            <span>Total Pembayaran</span>
            <span>Rp 165.000</span>
        </div>

        <a href="{{ route('user.payment') }}" class="btn-checkout">Proses Pembayaran</a>
    </div>
</div>
@endsection
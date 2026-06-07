@extends('layout.user')

@section('content')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">

<div class="payment-container">
    <div class="payment-header">
        <h2>Selesaikan Pembayaran</h2>
        <p>Batas Waktu Pembayaran: 23:59:59</p> 
    </div>

    <div>Total yang harus dibayar:</div>
    <div class="payment-amount">Rp 150.000</div>

    <div class="va-box">
        <div class="va-title">Transfer ke Bank BCA (Virtual Account)</div>
        <div class="va-number">8077 0812 3456 7890</div>
    </div>

    <div class="instruction-box">
        <h4>Cara Pembayaran via m-BCA:</h4>
        <ul class="instruction-list">
            <li>Buka aplikasi BCA mobile dan login ke m-BCA.</li>
            <li>Pilih menu <strong>m-Transfer</strong>.</li>
            <li>Pilih <strong>BCA Virtual Account</strong>.</li>
            <li>Masukkan nomor Virtual Account di atas.</li>
            <li>Pastikan nominal tagihan sudah benar, lalu masukkan PIN m-BCA.</li>
            <li>Pembayaran selesai. Simpan bukti transfer Anda.</li>
        </ul>
    </div>

    <a href="{{ route('user.home') }}" class="btn-confirm" onclick="alert('Pembayaran Dummy Berhasil Dikonfirmasi!')">Saya Sudah Bayar</a>
</div>
@endsection

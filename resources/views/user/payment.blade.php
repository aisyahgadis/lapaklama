@extends('layout.user')

@section('content')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">

<div class="payment-container">
    <div class="payment-header">
        <h2>Selesaikan Pembayaran</h2>
        <p>Batas Waktu Pembayaran: <span id="timer" style="font-weight: bold; color: red;">23:59:59</span></p> 
    </div>

    @php
        $ongkir = 15000;
        $total = $product->harga + $ongkir;
    @endphp

    <div>Total yang harus dibayar:</div>
    <div class="payment-amount">Rp {{ number_format($total, 0, ',', '.') }}</div>

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

    <form action="{{ route('user.payment.process', $product->id) }}" method="POST" style="margin-top: 20px;">
        @csrf
        <button type="submit" class="btn-confirm" onclick="return confirm('Apakah Anda yakin sudah melakukan transfer? Pesanan akan segera diproses.')" style="width: 100%; border: none; cursor: pointer;">
            Saya Sudah Bayar
        </button>
    </form>
</div>

<script>
    // Set waktu hitung mundur (contoh: 24 jam dalam satuan detik)
    let countdownTime = 24 * 60 * 60; 
    const timerElement = document.getElementById('timer');

    const countdownInterval = setInterval(function() {
        // Kalkulasi jam, menit, dan detik
        let hours = Math.floor(countdownTime / 3600);
        let minutes = Math.floor((countdownTime % 3600) / 60);
        let seconds = countdownTime % 60;

        // Tambahkan angka '0' di depan jika angkanya di bawah 10 (agar format tetap 00:00:00)
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        // Tampilkan ke layar
        timerElement.textContent = hours + ':' + minutes + ':' + seconds;

        // Jika waktu habis
        if (countdownTime <= 0) {
            clearInterval(countdownInterval);
            timerElement.textContent = "WAKTU HABIS";
            timerElement.style.color = "grey";
            
            // Opsional: Sembunyikan tombol bayar jika waktu habis
            document.querySelector('form').style.display = 'none';
        }

        // Kurangi waktu 1 detik setiap perulangan
        countdownTime--;
    }, 1000); // 1000 milidetik = 1 detik
</script>
@endsection
@extends('layout.user')
@section('title', 'Ide Daur Ulang Dikirim')
@section('content')
<link rel="stylesheet" href="{{ asset('css/succes.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="success-page">
    <div class="success-card">
        <i class="bi bi-check-circle-fill success-icon"></i>
        <h2>Ide Daur Ulang Dikirim!</h2>
        <p>Terima kasih sudah menjadi bagian dari gerakan ramah lingkungan bersama Lapak Lama. Ide kreatifmu sudah masuk ke dalam antrean review kami.</p>
        
        <!-- Arahkan ke halaman tracking yang kita buat sebelumnya -->
        <a href="{{ route('user.user-tracking') }}" class="btn-to-tracking">
            Pantau Progres Baju Saya <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
</div>
@endsection
@extends('layout.web')

@section('title', 'About Us - LapakLama')

@section('content')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">


<div class="about-page-container">
    <div class="container">
        
        <div class="about-hero">
            <h2 class="about-title">Tentang LapakLama</h2>
            <p class="about-desc">
                LapakLama hadir sebagai solusi gaya hidup yang lebih berkelanjutan. Kami adalah platform yang tidak hanya memungkinkan kamu untuk jual-beli pakaian pre-loved favorit, tapi juga menyediakan layanan daur ulang fashion (Recycle) agar pakaian lamamu punya cerita dan fungsi baru. Tampil *stylish* nggak harus mahal, dan pastinya bisa tetap ramah lingkungan!
            </p>
        </div>

        <div class="testimonial-section text-center">
            <h3 class="about-title mb-5" style="font-size: 2rem;">Apa Kata Mereka?</h3>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <div class="testi-icon"><i class="bi bi-chat-quote-fill"></i></div>
                        <p class="testi-text">"Sumpah fitur recycle-nya ngebantu banget! Baju denim aku yang udah robek disulap jadi totebag super estetik. Sukses terus LapakLama!"</p>
                        <div class="testi-name">Rina Kirana</div>
                        <div class="testi-role">Pelajar, 17 Thn</div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <div class="testi-icon"><i class="bi bi-chat-quote-fill"></i></div>
                        <p class="testi-text">"Jual baju bekas di sini gampang banget laku. Navigasinya simpel, dan ngebantu banget buat nambah uang jajan sambil ngosongin lemari."</p>
                        <div class="testi-name">Dimas Anggara</div>
                        <div class="testi-role">Mahasiswa, 20 Thn</div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <div class="testi-icon"><i class="bi bi-chat-quote-fill"></i></div>
                        <p class="testi-text">"Harganya miring-miring tapi kualitas thrifting-nya oke punya. Beli baju bekas berasa dapet baju baru dari mall. Recommended!"</p>
                        <div class="testi-name">Alya M.</div>
                        <div class="testi-role">Karyawan Swasta</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
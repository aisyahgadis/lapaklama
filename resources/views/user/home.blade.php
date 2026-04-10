<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="logo">Lapaklama</div>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('jual') }}">Jual</a></li>
            <li><a href="{{ route('daurulang') }}">Daur Ulang</a></li>
            <li><a href="{{ route('login') }}" class="login-btn">login</a></li>
        </ul>
    </nav>
    <div class="container">
        <header class="header">
            <h1>Selamat Datang di Lapaklama</h1>
            <p>Ubah Baju Lamamu Jadi Lebih Bernilai.</p>
        </header>
        <section class="latest-products">
            <h2>Produk Terbaru </h2>
            <p>Temukan produk-produk terbaru yang siap untuk dijual kembali!</p>

            <div class="slider">
                <div class="slide-track">

                    <!-- Ulangi product-card sesuai kebutuhan -->
                    <div class="product-card">
                        <img src="https://i.pinimg.com/1200x/6a/06/ab/6a06abbe6d5a0651a2cc2233f16eb981.jpg" alt="">
                        <h3>Jaket Vintage</h3>
                        <p>Rp 120.000</p>
                    </div>

                    <div class="product-card">
                        <img src="https://i.pinimg.com/1200x/1c/13/7b/1c137b62f2cb80630aa00fa9a07f5a14.jpg" alt="">
                        <h3>Kemeja Flanel</h3>
                        <p>Rp 75.000</p>
                    </div>

                    <div class="product-card">
                        <img src="https://i.pinimg.com/1200x/d9/54/6b/d9546ba16c59e87e80096b303bb73bae.jpg" alt="">
                        <h3>Dress Retro</h3>
                        <p>Rp 95.000</p>
                    </div>

                    <div class="product-card">
                        <img src="https://i.pinimg.com/1200x/11/cf/5b/11cf5bffa4c0588256885044c62aef8f.jpg" alt="">
                        <h3>Celana Denim</h3>
                        <p>Rp 110.000</p>
                    </div>

                    <!-- DUPLIKASI untuk infinite smooth -->
                    <div class="product-card">
                        <img src="https://i.pinimg.com/1200x/7d/9d/0f/7d9d0fe0ceee5ad3cb48977a1131e739.jpg" alt="">
                        <h3>Jaket Vintage</h3>
                        <p>Rp 120.000</p>
                    </div>

                    <div class="product-card">
                        <img src="https://i.pinimg.com/1200x/d8/db/84/d8db84505faf5b0515e592d5253a6738.jpg" alt="">
                        <h3>Kemeja Flanel</h3>
                        <p>Rp 75.000</p>
                    </div>

                </div>
            </div>
        </section>
        <section class="recycle-collection">

    <h2>Discover Recycle Collection</h2>
    <p class="subtitle">Baju lama yang diubah menjadi fashion baru</p>

    <div class="recycle-slider-container">

        <button class="recycle-btn left">&#10094;</button>

        <div class="recycle-slider">

            <img src="https://i.pinimg.com/736x/b1/eb/82/b1eb8227368bd1153138d7bb84cba72c.jpg" class="recycle-item">
            <img src="https://i.pinimg.com/736x/b1/eb/82/b1eb8227368bd1153138d7bb84cba72c.jpg" class="recycle-item">
            <img src="https://i.pinimg.com/736x/b1/eb/82/b1eb8227368bd1153138d7bb84cba72c.jpg" class="recycle-item">
            <img src="https://i.pinimg.com/736x/b1/eb/82/b1eb8227368bd1153138d7bb84cba72c.jpg" class="recycle-item">
            <img src="https://i.pinimg.com/736x/b1/eb/82/b1eb8227368bd1153138d7bb84cba72c.jpg" class="recycle-item">

        </div>

        <button class="recycle-btn right">&#10095;</button>

    </div>

    <div class="see-more">
        <a href="#">Lihat Semua</a>
    </div>

</section>
    
        <h2 class="title">Ayo coba Lapaklama sekarang!</h2>
        <main class="main">
            <div class="card">
                <h2>Jual Baju Bekasmu</h2>
                <p>Ubah baju bekasmu menjadi uang dengan mudah di Lapaklama. Cukup daftar, unggah foto, dan jual!</p>
                <a href="{{ route('jual') }}" class="btn">Jual Sekarang</a>
            </div>
            <div class="card">
                <h2>Beli Baju Bekas Berkualitas</h2>
                <p>Temukan baju bekas berkualitas dengan harga terjangkau di Lapaklama. Cari, pilih, dan beli dengan mudah!</p>
                <a href="{{ route('baju') }}" class="btn">Belanja Sekarang</a>
            </div>
            <div class="card">
                <h2>Ubah Baju Lamamu Jadi Lebih Bernilai</h2>
                <p>Lapaklama membantu kamu mengubah baju lamamu menjadi lebih bernilai. Jual atau beli baju bekas dengan mudah dan cepat!</p>
                <a href="{{ route('daurulang') }}" class="btn">Mulai Sekarang</a>
            </div>
        </main>
        <!--Tentang Section -->
    </div>
</body>
</html>
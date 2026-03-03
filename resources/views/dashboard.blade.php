<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
<div class="container">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <!-- LOGO -->
        <h2 class="logo">Lapaklama</h2>
        <!-- PROFIL ADMIN -->
        <div class="sidebar-profile">
            <img src="{{ asset('img/image.png') }}" alt="Admin">
            <span class="profile-name">Admin</span>
        </div>
        <!-- MENU -->
        <ul class="menu">
            <li class="menu-item active">Dashboard</li>
            <li class="menu-item"><a href="{{ route('user') }}">User</a></li>
            <li class="menu-item"><a href="{{ route('product') }}">Product</a></li>
            <li class="menu-item"><a href="{{ route('activity') }}">Activity</a></li>
        </ul>
    </aside>
    <!-- CONTENT -->
    <div class="content">
        <!-- HEADER -->
        <header class="header">
            <div class="header-left">
                <!-- tombol menu -->
                <div class="menu-btn">☰</div>
                <!-- search bar -->
                <input type="text" class="search" placeholder="Search">
            </div>
            <!-- logout -->
            <button class="logout">Log Out</button>
        </header>
        <!-- MAIN -->
        <main class="main">
            <!-- CARD USER -->
            <input type="checkbox" id="popupUser" hidden> 
            <label for="popupUser" class="card">
                <p>User</p>
                <h1>db</h1>
            </label>
            <!-- CARD STORY -->
            <label for="popupUser" class="card">
                <p>Story</p>
                <h1>db</h1>
            </label>
            <!-- CARD SHOP -->
            <label for="popupUser" class="card">
                <p>Product</p>
                <h1>db</h1>
            </label>
            <!-- CARD ACTIVITY -->
            <label for="popupUser" class="card">
                <p>Activity</p>
                <h1>db</h1> 
            </label>
        </main>
    </div>
</div>
</body>
</html>
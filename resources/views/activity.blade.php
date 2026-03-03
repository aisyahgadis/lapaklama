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
        <h2 class="logo">MyKisah</h2>
        <!-- PROFIL ADMIN -->
        <div class="sidebar-profile">
            <img src="{{ asset('img/image.png') }}" alt="Admin">
            <span class="profile-name">Admin</span>
        </div>
        <!-- MENU -->
        <ul class="menu">
            <li class="menu-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="menu-item active"><a href="{{ route('user') }}">User</a></li>
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
    </div>
</div>
</body>
</html>
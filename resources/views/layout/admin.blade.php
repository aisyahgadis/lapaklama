<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Lapaklama</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-panel.css') }}">
</head>
<body>
        <div class="admin-container">
            <aside class="sidebar">
        <div class="sidebar-logo">
            <h2>Lapaklama.</h2>
            <p>Admin Panel</p>
        </div>
        
        <div class="user-profile-sidebar" style="padding: 20px; display: flex; align-items: center; gap: 10px;">
            <div class="avatar" style="background-color: #00bfa5; color: white; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                AD
            </div>
            <span style="color: white; font-weight: 500;">Super Admin</span>
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    DB Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('user') }}" class="{{ request()->routeIs('user') ? 'active' : '' }}">
                    US Data User
                </a>
            </li>
            <li>
                <a href="{{ route('persetujuan') }}" class="{{ request()->routeIs('persetujuan') ? 'active' : '' }}">
                    PZ Persetujuan Penjual
                </a>
            </li>
            <li>
                <a href="{{ route('recycle-detail') }}" class="{{ request()->routeIs('recycle-detail') ? 'active' : '' }}">
                    PJ Kelola Penjahit
                </a>
            </li>
            <li>
                <a href="{{ route('product') }}" class="{{ request()->routeIs('product') ? 'active' : '' }}">
                    PR Data Produk
                </a>
            </li>
        </ul>

        <div class="sidebar-footer" style="padding: 20px; margin-top: auto;">
            <a href="{{ route('logout') }}" class="btn-logout" style="background-color: #e74c3c; color: white; display: block; text-align: center; padding: 12px; border-radius: 8px; text-decoration: none; font-weight: bold;">
                Log Out
            </a>
        </div>
    </aside>
        <div class="main-wrapper"> 
                <header class="top-navbar">
                    <div class="nav-left">
                        <input type="text" class="search-input" placeholder="Cari data...">
                    </div>
                    <div class="nav-right">
                        <div class="nav-profile">Admin Lapaklama</div>
                    </div>
                </header>
            <main class="main-content">
                @yield('content')
            </main>
        </div>
</body>
</html>
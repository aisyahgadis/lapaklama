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
        <h2 class="logo">Lapaklama</h2>

        <div class="sidebar-profile">
            <img src="{{ asset('img/image.png') }}" alt="Admin">
            <span class="profile-name">Admin</span>
        </div>

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
                <div class="menu-btn">☰</div>
                <input type="text" class="search" placeholder="Search">
            </div>
            <button class="logout">Log Out</button>
        </header>

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <div class="crud-container">
                <div class="crud-header">
                    <h2>Data User</h2>
                    <button class="btn-add">+ Tambah User</button>
                </div>

                <table class="crud-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Aisyah</td>
                            <td>aisyah@gmail.com</td>
                            <td>bisa di edit</td>`
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Rahma</td>
                            <td>rahma@gmail.com</td>
                            <td>bisa di edit</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </main>

    </div>
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lapaklama')</title>

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    <!-- Navbar Global (kalau mau selalu muncul) -->
    {{-- Bisa taruh navbar di sini kalau ingin global --}}

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Lapaklama. All rights reserved.</p>
    </footer>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<!---LOGIN ADMIN--->
<Section id="login-admin"></Section>
<nav>
    <div class="wrapper">
        <form action="" method="post">
            @csrf
            <h2>Login Admin</h2>
            <div class="input-box">
                <span class="icon"><i class='bx bxs-user'></i></span>
                <input type="text" required name="username" placeholder="Username">
            </div>
            <div class="input-box">
                <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                <input type="password" required name="password" placeholder="Password">
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot password?</a>
            </div>
            <br>
            <button type="submit" class="btn">Login</button>
            <br>
            <div class="login-register">
                <p>Don't have an account? <a href="#">Sign up</a></p>
            </div>
        </form>
    </div>
<body>
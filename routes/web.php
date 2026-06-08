<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RecycleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// =========================================================
// 1. ROUTE TANPA LOGIN (PUBLIC & GUEST)
// =========================================================

// Halaman user sebelum login
Route::get('/user-login/home-login', function () {
    return view('user-login.home-login');
})->name('user-login.home');

Route::get('/user-login/about', function () {
    return view('user-login.about');
})->name('user-login.about');

// Autentikasi (Login & Register)
Route::get('/sesi/index', [SessionController::class, 'index'])->name('login');
Route::post('/sesi/index', [SessionController::class, 'store'])->name('login.post');
Route::get('/sesi/register', [SessionController::class, 'register'])->name('register');
Route::post('/sesi/register', [SessionController::class, 'storeRegister'])->name('register.post');

// =========================================================
// 2. ROUTE WAJIB LOGIN (AUTH MIDDLEWARE)
// =========================================================
Route::middleware(['auth'])->group(function () {

    // --- LOGOUT ---
    Route::get('/sesi/logout', [SessionController::class, 'logout'])->name('logout');

    // =====================================================
    // ADMIN ROUTES
    // =====================================================
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/user', [AdminController::class, 'users'])->name('admin.user');
    Route::delete('/admin/user/{id}', [AdminController::class, 'destroyUser'])->name('admin.user.destroy');
    Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('/admin/persetujuan', [AdminController::class, 'persetujuan'])->name('admin.persetujuan');
    Route::post('/admin/persetujuan/pilih', [PersetujuanController::class, 'pilihPenjahit'])->name('admin.persetujuan.pilih');

    Route::get('/admin/recycle-detail', [AdminController::class, 'recycleDetail'])->name('admin.recycle-detail');

    // =====================================================
    // PENJUAL ROUTES
    // =====================================================

    // Halaman utama penjual
    Route::get('/main', function () {
        return view('penjual.main');
    })->name('main');

    // Jual baju (form)
    Route::get('/jual', function () {
        return view('penjual.jual');
    })->name('jual');

    // Proses simpan produk dari form jual
    Route::post('/jual', [ProductController::class, 'store'])->name('product.store');

    // Halaman beli (katalog penjual)
    Route::get('/beli', function () {
        return view('penjual.beli');
    })->name('beli');

    // Daftar produk penjual
    Route::get('/view-product', [ProductController::class, 'sellerProducts'])->name('penjual.product');

    // Edit produk penjual
    Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('penjual.edit-product');
    Route::put('/edit-product/{id}', [ProductController::class, 'update'])->name('penjual.update-product');

    // Hapus produk penjual
    Route::delete('/delete-product/{id}', [ProductController::class, 'destroy'])->name('penjual.destroy-product');

    // Daur ulang
    Route::get('/daurulang', function () {
        return view('penjual.daurulang');
    })->name('daurulang');

    // Form daur ulang
    Route::get('/form', function () {
        return view('penjual.form');
    })->name('penjual.form');

    // Proses simpan daur ulang
    Route::post('/form', [RecycleController::class, 'store'])->name('recycle.store');

    // Tracking daur ulang penjual
    Route::get('/tracking', [RecycleController::class, 'tracking'])->name('penjual.tracking');

    // Halaman sukses
    Route::get('/success', function () {
        return view('penjual.succes');
    })->name('penjual.succes');

    Route::get('/success-jual', function () {
        return view('penjual.success-jual');
    })->name('penjual.success-jual');

    // =====================================================
    // USER (PEMBELI) ROUTES
    // =====================================================

    // Halaman utama user
    Route::get('/user/home', function () {
        return view('user.home');
    })->name('user.home');

    // Katalog (dengan filter database)
    Route::get('/user/buy-user', [ProductController::class, 'katalog'])->name('user.buy-user');

    // Detail Produk
    Route::get('/user/product/{id}', [ProductController::class, 'detail'])->name('user.view-product');

    // Checkout
    Route::get('/user/checkout/{id}', [ProductController::class, 'checkout'])->name('user.checkout');

    // Payment page
    Route::get('/user/payment/{id}', [ProductController::class, 'payment'])->name('user.payment');

    // Proses Pembayaran
    Route::post('/user/payment/{id}/process', [ProductController::class, 'prosesPembayaran'])->name('user.payment.process');

    // Recycle user
    Route::get('/user/recyle-user', function () {
        return view('user.recyle-user');
    })->name('user.recyle-user');

    // Tracking user
    Route::get('/user/tracking', [RecycleController::class, 'userTracking'])->name('user.user-tracking');

    // Form daur ulang user
    Route::get('/user/form', function () {
        return view('user.user-form');
    })->name('user.user-form');

    // Success user
    Route::get('/user/succes', function () {
        return view('user.user-succes');
    })->name('user.user-succes');
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ProductController; // Tambahan untuk fitur jual baju
use App\Http\Controllers\PersetujuanController; // Import ini wajib karena dipakai di rute admin
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
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
Route::post('/sesi/index', [SessionController::class, 'store']);
Route::get('/sesi/register', [SessionController::class, 'register'])->name('register');
Route::post('/sesi/register', [SessionController::class, 'storeRegister']);

// Route untuk menampilkan halaman form login kamu
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route untuk memproses data dari form (URL menyesuaikan dengan action di form kamu)
Route::post('/user/main', [AuthController::class, 'login'])->name('login.post');
// =========================================================
// 2. ROUTE WAJIB LOGIN (AUTH MIDDLEWARE)
// =========================================================
Route::middleware(['auth'])->group(function () {

    // --- LOGOUT ---
    Route::get('/sesi/logout', [SessionController::class, 'logout'])->name('logout');

    // --- HALAMAN ADMIN ---
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/recycle-detail', function () {
        return view('admin.recycle-detail');
    })->name('recycle-detail');

    Route::post('/admin/persetujuan/pilih', [PersetujuanController::class, 'pilihPenjahit'])->name('admin.persetujuan.pilih');

    Route::get('/user', function () {
        return view('admin.user');
    })->name('user');

    Route::get('/product', function () {
        return view('admin.product');
    })->name('product');

    Route::get('/persetujuan', function () {
        return view('admin.persetujuan');
    })->name('persetujuan');


    // --- HALAMAN PENJUAL ---
    Route::get('/jual', function () {
        return view('penjual.jual');
    })->name('jual');

    // INI ROUTE BARU UNTUK MENERIMA DATA DARI FORM JUAL BAJU
    Route::post('/jual', [ProductController::class, 'store'])->name('product.store');

    // Route untuk menampilkan halaman data produk
    Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');

    // Route post dari form simpan produk milikmu sebelumnya
    Route::post('/penjual/jual', [ProductController::class, 'store'])->name('penjual.jual');
    
    Route::get('/daurulang', function () {
        return view('penjual.daurulang');
    })->name('daurulang');

    Route::get('/main', function () {
        return view('penjual.main');
    })->name('main');

    Route::get('/beli', function () {
        return view('penjual.beli');
    })->name('beli');

    Route::get('/form', function () {
        return view('penjual.form');
    })->name('penjual.form');

    Route::get('/tracking', function () {
        return view('penjual.tracking');
    })->name('penjual.tracking');

    Route::get('/success', function () {
        return view('penjual.succes');
    })->name('penjual.succes');

    Route::get('/success-jual', function () {
        return view('penjual.success-jual');
    })->name('penjual.success-jual');

    Route::get('/view-product', function () {
        return view('penjual.product');
    })->name('penjual.product');

    Route::get('/edit-product', function () {
        return view('penjual.edit-product');
    })->name('penjual.edit-product');


    // --- HALAMAN USER SUDAH LOGIN ---
    Route::get('/user/home', function () {
        return view('user.home');
    })->name('user.home');

    // 1. Halaman Katalog (Menampilkan semua produk & filter)
    Route::get('/user/buy-user', [ProductController::class, 'katalog'])->name('user.buy-user');

    // 2. Halaman Detail Produk (Saat produk diklik)
    Route::get('/user/product/{id}', [ProductController::class, 'detail'])->name('user.view-product');

    // 3. Halaman Checkout (Setelah fiks mau beli dari halaman detail)
    Route::get('/user/checkout/{id}', [ProductController::class, 'checkout'])->name('user.checkout');

    // 4. Proses Pembayaran (Tombol "Bayar" di halaman checkout)
    Route::post('/user/payment/{id}', [ProductController::class, 'prosesPembayaran'])->name('user.payment');
    
    Route::get('/user/recyle-user', function () {
        return view('user.recyle-user');
    })->name('user.recyle-user');

    Route::get('/user/tracking', function () {
        return view('user.user-tracking');
    })->name('user.user-tracking');

    Route::get('/user/form', function () {
        return view('user.user-form');
    })->name('user.user-form');

    Route::get('/user/succes', function () {
        return view('user.user-succes');
    })->name('user.user-succes');

    Route::get('/user/view-product', function () {
        return view('user.view-product');
    })->name('user.view-product');

    Route::get('/user/chekout', function () {
        return view('user.chekout');
    })->name('user.chekout');

    Route::get('/user/payment', function () {
        return view('user.payment');
    })->name('user.payment');

});
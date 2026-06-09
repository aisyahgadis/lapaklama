<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RecycleController;
use App\Http\Controllers\OrderController;

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

    // --- PROFILE ---
    Route::get('/profile', [SessionController::class, 'editProfile'])->name('profile');
    Route::put('/profile', [SessionController::class, 'updateProfile'])->name('profile.update');

    // =====================================================
    // ADMIN ROUTES
    // =====================================================
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/user', [AdminController::class, 'users'])->name('admin.user');
        Route::get('/admin/penjahit/create', [AdminController::class, 'createPenjahit'])->name('admin.penjahit.create');
        Route::post('/admin/penjahit/store', [AdminController::class, 'storePenjahit'])->name('admin.penjahit.store');
        Route::post('/admin/user/{id}/approve', [AdminController::class, 'approveSeller'])->name('admin.user.approve');
        Route::delete('/admin/user/{id}', [AdminController::class, 'destroyUser'])->name('admin.user.destroy');
        Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');
        Route::get('/admin/persetujuan', [AdminController::class, 'persetujuan'])->name('admin.persetujuan');
        Route::post('/admin/persetujuan/pilih', [PersetujuanController::class, 'pilihPenjahit'])->name('admin.persetujuan.pilih');

        Route::get('/admin/recycle-detail', [AdminController::class, 'recycleDetail'])->name('admin.recycle-detail');
        Route::post('/admin/recycle/{id}/assign', [AdminController::class, 'assignPenjahit'])->name('admin.recycle.assign');
        Route::post('/admin/recycle/{id}/update-status', [AdminController::class, 'updateRecycleStatus'])->name('admin.recycle.update-status');
    });

    // =====================================================
    // PENJUAL ROUTES
    // =====================================================
    Route::middleware(['seller.approved'])->group(function () {
        // Halaman utama penjual
        Route::get('/main', function () {
            $products = \App\Models\Product::where('status', 'tersedia')->orderBy('created_at', 'desc')->take(8)->get();
            return view('penjual.main', compact('products'));
        })->name('main');

        // Jual baju (form)
        Route::get('/jual', function () {
            return view('penjual.jual');
        })->name('jual');

        // Proses simpan produk dari form jual
        Route::post('/jual', [ProductController::class, 'store'])->name('product.store');

        // Halaman beli (katalog penjual)
        Route::get('/beli', [ProductController::class, 'katalog'])->name('beli');

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



        // Tracking daur ulang penjual
        Route::get('/tracking', [RecycleController::class, 'tracking'])->name('penjual.tracking');
        Route::post('/recycle/{id}/update-resi', [RecycleController::class, 'updateResi'])->name('penjual.recycle.update-resi');

        // Pesanan penjual
        Route::get('/pesanan', [OrderController::class, 'sellerOrders'])->name('penjual.orders');
        Route::post('/pesanan/{id}/terima', [OrderController::class, 'acceptOrder'])->name('penjual.orders.accept');
        Route::post('/pesanan/{id}/kirim', [OrderController::class, 'shipOrder'])->name('penjual.orders.ship');

        // Halaman sukses
        Route::get('/success', function () {
            return view('penjual.succes');
        })->name('penjual.succes');

        Route::get('/success-jual', function () {
            return view('penjual.success-jual');
        })->name('penjual.success-jual');

        // Order Flow Penjual
        Route::get('/penjual/orders', [OrderController::class, 'sellerOrders'])->name('penjual.orders');
        Route::post('/penjual/orders/{id}/accept', [OrderController::class, 'acceptOrder'])->name('penjual.orders.accept');
        Route::post('/penjual/orders/{id}/ship', [OrderController::class, 'shipOrder'])->name('penjual.orders.ship');
    });

    // =====================================================
    // PENJAHIT ROUTES (Dihapus sesuai permintaan)
    // =====================================================

    // =====================================================
    // REUSE (DAUR ULANG) ROUTES - UNTUK SEMUA USER
    // =====================================================
    // Proses simpan daur ulang (bisa diakses oleh penjual dan pembeli)
    Route::post('/recycle/store', [RecycleController::class, 'store'])->name('recycle.store');

    // =====================================================
    // USER (PEMBELI) ROUTES
    // =====================================================

    // Halaman utama user
    Route::get('/user/home', function () {
        $products = \App\Models\Product::where('status', 'tersedia')->orderBy('created_at', 'desc')->take(8)->get();
        return view('user.home', compact('products'));
    })->name('user.home');

    // Katalog (dengan filter database)
    Route::get('/user/buy-user', [ProductController::class, 'katalog'])->name('user.buy-user');

    // Detail Produk
    Route::get('/user/product/{id}', [ProductController::class, 'detail'])->name('user.view-product');

    // Checkout
    Route::get('/user/checkout/{id}', [ProductController::class, 'checkout'])->name('user.checkout');
    Route::post('/user/checkout/{id}/process', [ProductController::class, 'processCheckout'])->name('user.checkout.process');

    // Payment page
    Route::get('/user/payment/{id}', [ProductController::class, 'payment'])->name('user.payment');

    // Proses Pembayaran
    Route::post('/user/payment/{id}/process', [ProductController::class, 'prosesPembayaran'])->name('user.payment.process');

    // Order Flow Pembeli
    Route::get('/user/orders', [OrderController::class, 'userOrders'])->name('user.orders');
    Route::post('/user/orders/{id}/receive', [OrderController::class, 'receiveOrder'])->name('user.orders.receive');
    Route::post('/user/orders/{id}/review', [OrderController::class, 'submitReview'])->name('user.orders.review');

    // Recycle user
    Route::get('/user/recyle-user', function () {
        return view('user.recyle-user');
    })->name('user.recyle-user');

    // Tracking user
    Route::get('/user/tracking', [RecycleController::class, 'userTracking'])->name('user.user-tracking');
    Route::post('/user/recycle/{id}/update-resi', [RecycleController::class, 'updateResi'])->name('user.recycle.update-resi');

    // Form daur ulang user
    Route::get('/user/form', function () {
        return view('user.user-form');
    })->name('user.user-form');

    // Success user
    Route::get('/user/succes', function () {
        return view('user.user-succes');
    })->name('user.user-succes');
    Route::get('/user/about-user', function(){
        return view('user.about-user');
    })->name('user.about-user');
});
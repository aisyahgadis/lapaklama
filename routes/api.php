<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PenjahitApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ProductApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// API Auth (Login, Register, Logout)
Route::post('/auth/login', [AuthApiController::class, 'login'])->name('api.auth.login');
Route::post('/auth/register', [AuthApiController::class, 'register'])->name('api.auth.register');
Route::post('/auth/logout', [AuthApiController::class, 'logout'])->middleware('auth')->name('api.auth.logout');
Route::get('/auth/me', [AuthApiController::class, 'me'])->middleware('auth')->name('api.auth.me');


// API Produk untuk User (Pembeli) - bisa diakses tanpa login untuk katalog
Route::middleware(['web'])->group(function () {
    Route::get('/products/katalog', [ProductApiController::class, 'katalog'])->name('api.products.katalog');
    Route::get('/products/{id}/detail', [ProductApiController::class, 'detail'])->name('api.products.detail');
    
    // Memerlukan login untuk checkout dan pembayaran
    Route::middleware(['auth'])->group(function () {
        Route::post('/products/{id}/checkout', [ProductApiController::class, 'processCheckout'])->name('api.products.checkout');
        Route::post('/products/{id}/payment', [ProductApiController::class, 'prosesPembayaran'])->name('api.products.payment');
    });
});

// API Produk untuk Penjual
Route::middleware(['web', 'auth', 'seller.approved'])->group(function () {
    Route::get('/seller/products', [ProductApiController::class, 'sellerIndex'])->name('api.seller.products');
    Route::post('/seller/products', [ProductApiController::class, 'store'])->name('api.seller.products.store');
    Route::get('/seller/products/{id}', [ProductApiController::class, 'show'])->name('api.seller.products.show');
    Route::put('/seller/products/{id}', [ProductApiController::class, 'update'])->name('api.seller.products.update');
    Route::delete('/seller/products/{id}', [ProductApiController::class, 'destroy'])->name('api.seller.products.destroy');
});

// API Produk untuk Admin
Route::middleware(['web', 'auth', 'admin'])->group(function () {
    Route::get('/admin/products', [ProductApiController::class, 'adminIndex'])->name('api.admin.products');
    Route::resource('penjahit', PenjahitApiController::class);
});

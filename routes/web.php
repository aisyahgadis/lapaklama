<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//halaman admin
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/admin', function () {
    return view('admin.admin');
})->name('admin');

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
//halaman penjual
Route::get('/jual', function () {
    return view('penjual.jual');
})->name('jual');

Route::get('/baju', function () {
    return view('penjual.baju');
})->name('baju');

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
//halaman user sebelum login
Route::get('/user/home', function () {
    return view('user-login.home');
})->name('user-login.home');

Route::get('/buy', function () {
    return view('user-login.buy');
})->name('user-login.buy');

Route::get('/recyle', function () {
    return view('user-login.recyle');
})->name('user-login.recyle');

Route::get('/user/buy-user', function () {
    return view('user-login.buy-user');
})->name('user-login.buy-user');

//halaman user sudah login
Route::get('/user/home', function () {
    return view('user.home');
})->name('user.home');

Route::get('/user/buy-user', function () {
    return view('user.buy-user');
})->name('user.buy-user');

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

// Menampilkan halaman login
Route::get('/sesi/index', [SessionController::class, 'index'])->name('login');
// Memproses data login saat form di-submit
Route::post('/sesi/index', [SessionController::class, 'store']);
Route::get('/sesi/logout', [SessionController::class, 'logout'])->name('logout');
Route::get('/sesi/register', [SessionController::class, 'register'])->name('register');
Route::post('/sesi/register', [SessionController::class, 'storeRegister']);

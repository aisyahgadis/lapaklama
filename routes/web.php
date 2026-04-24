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

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/admin', function () {
    return view('admin.admin');
})->name('admin');

Route::get('/user', function () {
    return view('admin.user');
})->name('user');

Route::get('/product', function () {
    return view('admin.product');
})->name('product');

Route::get('/activity', function () {
    return view('admin.activity');
})->name('activity');

Route::get('/home', function () {
    return view('user.home');
})->name('home');

Route::get('/jual', function () {
    return view('user.jual');
})->name('jual');

Route::get('/baju', function () {
    return view('user.baju');
})->name('baju');

Route::get('/daurulang', function () {
    return view('user.daurulang');
})->name('daurulang');

Route::get('/main', function () {
    return view('user.main');
})->name('main');

Route::get('/beli', function () {
    return view('user.beli');
})->name('beli');

Route::get('/login', function () {
    return view('sesi.index');
})->name('login');


Route::get('/sesi', [SessionController::class, 'index'])->name('login');
Route::post('/sesi/login', [SessionController::class, 'login'])->name('login.post');
Route::get('/sesi/logout', [SessionController::class, 'logout'])->name('logout');

<?php

use Illuminate\Support\Facades\Route;

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
    return view('dashboard');
})->name('dashboard');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/user', function () {
    return view('user');
})->name('user');

Route::get('/product', function () {
    return view('product');
})->name('product');

Route::get('/activity', function () {
    return view('activity');
})->name('activity');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/jual', function () {
    return view('jual');
})->name('jual');

Route::get('/baju', function () {
    return view('baju');
})->name('baju');

Route::get('/daurulang', function () {
    return view('daurulang');
})->name('daurulang');

Route::get('/login', function () {
    return view('sesi.login');
})->name('login');
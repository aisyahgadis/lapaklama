<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PenjahitApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Penjahit (hanya bisa diakses oleh admin yang login)
// Gunakan middleware web agar bisa session authentication seperti web routes
Route::middleware(['web', 'auth', 'admin'])->prefix('penjahit')->group(function () {
    Route::get('/', [PenjahitApiController::class, 'index']);
    Route::post('/', [PenjahitApiController::class, 'store']);
    Route::get('/{id}', [PenjahitApiController::class, 'show']);
    Route::put('/{id}', [PenjahitApiController::class, 'update']);
    Route::delete('/{id}', [PenjahitApiController::class, 'destroy']);
});


<?php

use Illuminate\Http\Request;
//use produkapicontroller
use App\Http\Controllers\Api\ProdukApiController;
use App\Http\Controllers\Api\KategoriApiController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {
    // Endpoint untuk mengambil semua produk
    Route::get('/produk', [ProdukApiController::class, 'index']);

    // Endpoint untuk menambahkan produk baru
    Route::post('/produk', [ProdukApiController::class, 'store']);

    // Endpoint untuk menampilkan detail produk berdasarkan ID
    Route::get('/produk/{id}', [ProdukApiController::class, 'show']);

    // Endpoint untuk memperbarui produk
    Route::put('/produk/{id}', [ProdukApiController::class, 'update']);

    // Endpoint untuk menghapus produk
    Route::delete('/produk/{id}', [ProdukApiController::class, 'destroy']);
});

Route::prefix('v2')->group(function () {
    // Endpoint untuk mengambil semua kategori
    Route::get('/kategori', [KategoriApiController::class, 'index']);

    // Endpoint untuk menambahkan kategori baru
    Route::post('/kategori', [KategoriApiController::class, 'store']);

    // Endpoint untuk menampilkan detail kategori berdasarkan ID
    Route::get('/kategori/{id}', [KategoriApiController::class, 'show']);

    // Endpoint untuk memperbarui kategori
    // Route::put('/kategori/{id}', [KategoriApiController::class, 'update']);
    Route::put('/kategori/{kategori}', [KategoriApiController::class, 'update']);

    // Endpoint untuk menghapus kategori
    Route::delete('/kategori/{id}', [KategoriApiController::class, 'destroy']);
});

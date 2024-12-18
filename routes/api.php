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
    Route::get('/produk', [ProdukApiController::class, 'index'])->name('produk.index');
    Route::post('/produk', [ProdukApiController::class, 'store'])->name('produk.store');
    Route::get('/produk/{produk}', [ProdukApiController::class, 'show'])->name('produk.show');
    Route::put('/produk/{produk}', [ProdukApiController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{produk}', [ProdukApiController::class, 'destroy'])->name('produk.destroy');
});

Route::prefix('v2')->group(function () {
    // Endpoint untuk mengambil semua kategori
    Route::get('/kategori', [KategoriApiController::class, 'index'])->name('kategori.index');

    // Endpoint untuk menambahkan kategori baru
    Route::post('/kategori', [KategoriApiController::class, 'store'])->name('kategori.store');

    // Endpoint untuk menampilkan detail kategori berdasarkan ID
    Route::get('/kategori/{kategori}', [KategoriApiController::class, 'show'])->name('kategori.show');

    // Endpoint untuk memperbarui kategori
    Route::put('/kategori/{kategori}', [KategoriApiController::class, 'update'])->name('kategori.update');

    // Endpoint untuk menghapus kategori
    Route::delete('/kategori/{kategori}', [KategoriApiController::class, 'destroy'])->name('kategori.destroy');
});

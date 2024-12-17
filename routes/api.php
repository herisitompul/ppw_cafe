<?php

use Illuminate\Http\Request;
//use produkapicontroller
use App\Http\Controllers\Api\ProdukApiController;
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

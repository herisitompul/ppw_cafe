<?php

use App\Http\Middleware\Admin\AuthMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::match(['get', 'post'], 'login', action: 'AdminController@Login')->name('admin.login');
    Route::middleware(AuthMiddleware::class)->group(function () {
        Route::get('dashboard', 'AdminController@Dashboard')->name('admin.dashboard');
        Route::get('logout', 'AdminController@Logout')->name('admin.logout');
    });
});

// Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
// Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
// Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
// Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
// Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
// Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');

// Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
// Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
// Route::get('/kategori/index', [KategoriController::class, 'index'])->name('kategori.index');
// Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
// Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
// Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
// Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');

Route::resource('produk', ProdukController::class);
Route::resource('kategori', KategoriController::class);

// routes/web.php
Route::get('/user/dashboard', [ProdukController::class, 'dashboard'])->name('user.dashboard');
Route::get('/user/categori', [ProdukController::class, 'categori'])->name('user.categori');





Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

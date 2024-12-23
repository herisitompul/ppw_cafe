<?php

use App\Http\Middleware\Admin\AuthMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return redirect()->route('user.dashboard');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::match(['get', 'post'], 'login', action: 'AdminController@Login')->name('admin.login');
    Route::middleware(AuthMiddleware::class)->group(function () {
        Route::get('dashboard', 'AdminController@Dashboard')->name('admin.dashboard');
        Route::get('logout', 'AdminController@Logout')->name('admin.logout');
    });
});

Route::resource('produk', ProdukController::class);
Route::resource('kategori', KategoriController::class);
Route::post('/login', [LoginController::class, 'login'])->middleware('remember_me');

// routes/web.php
Route::get('/user/dashboard', [ProdukController::class, 'dashboard'])->name('user.dashboard');
Route::get('/user/index', [ProdukController::class, 'index'])->name('user.index');
Route::get('/user/show/{id}', [ProdukController::class, 'show'])->name('user.show');
Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('user.kategori');

// User category route
Route::get('/user/kategori/{id}', [ProdukController::class, 'kategoriProduk'])->name('user.kategori');

Route::get('/user/ulasan', [ProdukController::class, 'ulasan'])->name('user.ulasan');

Route::get('/search', [ProdukController::class, 'search'])->name('product.search');
Route::get('/searchProduct', [ProdukController::class, 'searchProduct'])->name('search.product');

Route::get('/pesanan', [ProdukController::class, 'myOrder'])->name('pesanan.saya');
//daftar
Route::get('/daftar', [ProdukController::class, 'daftar'])->name('produk.daftar');
Route::delete('/orders/{id}', [ProdukController::class, 'deleteOrder'])->name('order.delete');

Route::put('/daftar/{id}', [ProdukController::class, 'cancel'])->name('daftar.cancel');
Route::get('/admin/reviews', [ReviewController::class, 'index'])->name('admin.reviews.index');
Route::delete('/reviews/{id}', [ReviewController::class, 'deleteReview'])->name('review.delete');

Route::middleware(['auth'])->group(function () {
    Route::get('keranjang', [KeranjangController::class, 'Index'])->name('keranjang.index');
    Route::post('/keranjang/add', [KeranjangController::class, 'addToCart'])->name('add.cart');
    Route::put('/keranjang/updatestatus',[KeranjangController::class, 'UpdateStatus'])->name('keranjang.update.status');
    Route::put('/keranjang/updatekuantitas',[KeranjangController::class, 'UpdateKuantitas'])->name('keranjang.update.kuantitas');
    Route::delete('/delete/keranjang',[KeranjangController::class, 'Delete'])->name('delete.cart');

    Route::post('/addorder', [OrderController::class, 'addOrder'])->name('order.add');
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::put('/cancelorder/{id}', [OrderController::class, 'cancelOrder'])->name('cancel.order');

    Route::post('/pay-now', [OrderController::class, 'payNow'])->name('pay.now');

    Route::post('/payment/callback', [PaymentController::class, 'handleCallback']);
    Route::post('/midtrans-callback', [OrderController::class, 'callback']);
    Route::get('/invoice/{id}', [OrderController::class, 'invoice']);

    Route::get('/order/{order}/review', [ReviewController::class, 'create'])->name('order.review');
    Route::post('/order/{order}/review', [ReviewController::class, 'store'])->name('order.review.store');

});

Auth::routes();


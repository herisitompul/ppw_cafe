<?php

use App\Http\Middleware\Admin\AuthMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\KeranjangController;
// use App\Http\Controllers\CartController;


Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::match(['get', 'post'], 'login', action: 'AdminController@Login')->name('admin.login');
    Route::middleware(AuthMiddleware::class)->group(function () {
        Route::get('dashboard', 'AdminController@Dashboard')->name('admin.dashboard');
        Route::get('logout', 'AdminController@Logout')->name('admin.logout');
        Route::get('orders', 'AdminController@Orders')->name('admin.orders');
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

Route::post('/order/payment', [OrderController::class, 'payment'])->name('order.payment');
Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');
Route::post('/payment', [PaymentController::class, 'createSnapToken'])->name('payment.snap');
Route::post('/payment/notification', [PaymentController::class, 'handleNotification'])->name('payment.notification');
Route::post('/payment/store', [PaymentController::class, 'storeTransaction'])->name('payment.store');


Route::middleware(['auth'])->group(function () {
    // Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    // Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    // Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    // Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('keranjang', [KeranjangController::class, 'Index'])->name('keranjang.index');
    Route::post('/keranjang/add', [KeranjangController::class, 'addToCart'])->name('add.cart');
    Route::put('/keranjang/updatestatus',[KeranjangController::class, 'UpdateStatus'])->name('keranjang.update.status');
    Route::put('/keranjang/updatekuantitas',[KeranjangController::class, 'UpdateKuantitas'])->name('keranjang.update.kuantitas');
    Route::delete('/delete/keranjang',[KeranjangController::class, 'Delete'])->name('delete.cart');
    Route::post('/orders/create-from-cart', [OrderController::class, 'createOrderFromCart']);
    Route::get('/orders', [OrderController::class, 'getUserOrders']);
    Route::patch('/orders/{orderId}/status', [OrderController::class, 'updateOrderStatus']);

    // Order Item Routes
    Route::get('/order-items/{orderItemId}', [OrderItemController::class, 'getOrderItemDetails']);
});
Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::get('/success', function () {
    return view('payment.success');
})->name('payment.success');

Route::get('/pending', function () {
    return view('payment.pending');
})->name('payment.pending');

Route::post('/payment/snap', [PaymentController::class, 'checkoutWithQuantity'])->name('payment.snap');
Route::post('/midtrans/callback', [OrderController::class, 'callback'])->name('midtrans.callback');
Route::get('/orders/{order_id}', [OrderController::class, 'show'])->name('orders.show');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

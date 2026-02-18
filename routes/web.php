<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProductController::class, 'admin'])->name('admin.dashboard');
    Route::get('/productlist', [ProductController::class, 'productlist'])->name('admin.productList');
    Route::get('/orders', [CartController::class, 'orders'])->name('admin.orders');
    Route::post('/storeProduct', [ProductController::class, 'storeProduct'])->name('admin.storeProduct');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('admin.editProduct');
    Route::post('/product/{id}/update', [ProductController::class, 'update'])->name('admin.updateProduct');
    Route::delete('/product/{id}/delete', [ProductController::class, 'destroy'])->name('admin.deleteProduct');
});

Route::get('/', [ProductController::class, 'home'])->name('home');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loggedin', [AuthController::class, 'loggedin'])->name('loggedin');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registered', [AuthController::class, 'registered'])->name('registered');
Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::get('/productDetails/{id}', [ProductController::class, 'productDetails'])->name('productDetails');
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::get('/cart', [CartController::class, 'cartPage'])->name('cart.page');
Route::post('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/checkout/place-order', [CartController::class, 'placeOrder'])->name('checkout.placeOrder');
Route::get('/order/success/{order}', [CartController::class, 'orderSuccess'])->name('order.success');

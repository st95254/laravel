<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HistoryController;

Route::get('/', function () {
    return view('dashboard');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/products/gold', [ProductController::class, 'showGold'])->name('products.gold');
Route::get('/products/gold/fetch-gold-prices', [ProductController::class, 'fetchGoldPrice']);
Route::post('/products/gold/update-gold-prices', [ProductController::class, 'updateGoldPrice']);
Route::get('/products/tea', [ProductController::class, 'showTea'])->name('products.tea');
Route::get('/products/{id}', [ProductController::class, 'showDetail'])->name('products.detail');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart/checkout/complete', function () {
    return view('cart.checkout-complete');
})->middleware(['auth', 'verified'])->name('checkout.complete');

Route::get('/history', [HistoryController::class, 'index'])->name('history.index')->middleware('auth');
Route::get('/history/{history_id}', [HistoryController::class, 'showHistoryItems'])->name('history.items')->middleware('auth');

Route::get('/return', function () {
    return view('/policies/return');
})->name('policies.return');

Route::get('/privacy', function () {
    return view('/policies/privacy');
})->name('policies.privacy');

// Admin
Route::get('/admin', function () {
    return view('/admin/dashboard');
})->name('admin.dashboard')->middleware('auth');
Route::get('/admin/history', [HistoryController::class, 'showAllUserHistories'])->name('admin.history')->middleware('auth');
Route::post('/admin/history/user', [HistoryController::class, 'searchUserHistoriesByEmail'])->name('history.user')->middleware('auth');
Route::post('/admin/history/search', [HistoryController::class, 'searchHistoriesByTradeNo'])->name('history.search')->middleware('auth');
Route::post('/admin/history/update-status', [HistoryController::class, 'updateHistoryStatus'])->name('history.updateStatus')->middleware('auth');
Route::resource('/admin/product', ProductController::class);

require __DIR__.'/auth.php';

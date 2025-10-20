<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

// Landing pública
Route::view('/', 'home')->name('home');

// Rutas de autenticación (Breeze)
require __DIR__.'/auth.php';

// Carrito y checkout (específicas)
Route::post('/cart/add',    [CartController::class, 'add'])->name('cart.add');
Route::get('/cart',         [CartController::class, 'view'])->name('cart.view');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/checkout',         [CheckoutController::class, 'create'])->name('checkout.create');
Route::get('/thank-you/{order}', [CheckoutController::class, 'thankyou'])->name('checkout.thankyou');

// Panel (autenticado)
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/products', 'products.index')->name('products.index');
});

// ===== Deja la tienda (comodín) al FINAL con restricción de slugs =====
Route::get('/{store:slug}', [ShopController::class, 'index'])
    ->where('store', '^(?!cart$|checkout$|login$|register$|password|email|verify-email|thank-you$).+')
    ->name('shop.index');

Route::get('/{store:slug}/producto/{product}', [ShopController::class, 'show'])
    ->where('store', '^(?!cart$|checkout$|login$|register$|password|email|verify-email|thank-you$).+')
    ->name('shop.show');


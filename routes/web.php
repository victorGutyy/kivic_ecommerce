<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

// Home → redirige a la demo (ajusta el slug si cambias en el seeder)
Route::get('/', fn() => redirect('/moda-basica'));

// Tienda pública
Route::get('/{store:slug}', [ShopController::class, 'index'])->name('shop.index');
Route::get('/{store:slug}/producto/{product}', [ShopController::class, 'show'])->name('shop.show');

// Carrito (session)
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Checkout mock → crea order y order_items
Route::post('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
Route::get('/thank-you/{order}', [CheckoutController::class, 'thankyou'])->name('checkout.thankyou');

// Panel (ya con Breeze/Livewire)
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/products', 'products.index')->name('products.index');
});

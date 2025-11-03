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
// Carrito
Route::get('/cart',            [CartController::class, 'view'])->name('cart.view');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update',    [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove',    [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear',     [CartController::class, 'clear'])->name('cart.clear');


Route::post('/checkout',         [CheckoutController::class, 'create'])->name('checkout.create');
Route::get('/thank-you/{order}', [CheckoutController::class, 'thankyou'])->name('checkout.thankyou');

// ePayco
Route::match(['GET','POST'], '/payment/epayco/response', [\App\Http\Controllers\PaymentController::class, 'epaycoResponse'])->name('epayco.response');
Route::match(['GET','POST'], '/payment/epayco/confirm', [\App\Http\Controllers\PaymentController::class, 'epaycoConfirm'])->name('epayco.confirm');

// Panel (autenticado)
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/products', 'products.index')->name('products.index');
});

Route::get('/admin/orders', function () {
    $orders = \App\Models\Order::with('items')->latest()->limit(50)->get();
    return view('admin.orders', compact('orders'));
});


// ===== Deja la tienda (comodín) al FINAL con restricción de slugs =====
Route::get('/{store:slug}', [ShopController::class, 'index'])
    ->where('store', '^(?!cart$|checkout$|login$|register$|password|email|verify-email|thank-you$).+')
    ->name('shop.index');

Route::get('/{store:slug}/producto/{product}', [ShopController::class, 'show'])
    ->where('store', '^(?!cart$|checkout$|login$|register$|password|email|verify-email|thank-you$).+')
    ->name('shop.show');


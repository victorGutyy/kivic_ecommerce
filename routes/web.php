<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\StoreOnboardingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreProductController;
use App\Http\Controllers\HomeController;

// Landing pública
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth (Breeze)
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (usuario autenticado)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/tiendas/{store}/productos', [StoreProductController::class, 'index'])
    ->name('stores.products.index');

Route::get('/tiendas/{store}/productos/crear', [StoreProductController::class, 'create'])
    ->name('stores.products.create');

Route::post('/tiendas/{store}/productos', [StoreProductController::class, 'store'])
    ->name('stores.products.store');

    // =========================
    // PERFIL DE USUARIO (Breeze)
    // =========================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // =========================
    // WIZARD CREACIÓN DE TIENDA
    // =========================
    Route::get('/crear-tienda/paso-1', [StoreOnboardingController::class, 'step1'])
        ->name('stores.create.step1');

    Route::post('/crear-tienda/paso-1', [StoreOnboardingController::class, 'storeStep1'])
        ->name('stores.store.step1');

    Route::get('/crear-tienda/paso-2', [StoreOnboardingController::class, 'step2'])
        ->name('stores.create.step2');

    Route::post('/crear-tienda/paso-2', [StoreOnboardingController::class, 'storeStep2'])
        ->name('stores.store.step2');

    Route::get('/crear-tienda/paso-3', [StoreOnboardingController::class, 'step3'])
        ->name('stores.create.step3');

    Route::post('/crear-tienda/finish', [StoreOnboardingController::class, 'finish'])
        ->name('stores.finish');

    // Panel / Dashboard
   Route::get('/dashboard', function () {
    $stores = \App\Models\Store::where('owner_id', auth()->id())->get();

    return view('panel.dashboard', compact('stores'));
})->name('dashboard');


    Route::view('/products', 'products.index')->name('products.index');

    // Admin de pedidos (por ahora solo protegido por login)
    Route::get('/admin/orders', function () {
        $orders = \App\Models\Order::with('items')->latest()->limit(50)->get();
        return view('admin.orders', compact('orders'));
    })->name('admin.orders');
});

/*
|--------------------------------------------------------------------------
| CARRITO & CHECKOUT (público, pero ligado a sesión)
|--------------------------------------------------------------------------
*/

// Carrito
Route::get('/cart',                 [CartController::class, 'view'])->name('cart.view');
Route::post('/cart/add/{product}',  [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update',         [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove',         [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear',          [CartController::class, 'clear'])->name('cart.clear');

// Checkout
Route::post('/checkout',            [CheckoutController::class, 'create'])->name('checkout.create');
Route::get('/thank-you/{order}',    [CheckoutController::class, 'thankyou'])->name('checkout.thankyou');

// ePayco
Route::match(['GET','POST'], '/payment/epayco/response', [PaymentController::class, 'epaycoResponse'])
    ->name('epayco.response');

Route::match(['GET','POST'], '/payment/epayco/confirm', [PaymentController::class, 'epaycoConfirm'])
    ->name('epayco.confirm');


/*
|--------------------------------------------------------------------------
| TIENDA PÚBLICA (DEJAR SIEMPRE AL FINAL)
|--------------------------------------------------------------------------
*/

Route::get('/{store:slug}', [ShopController::class, 'index'])
    ->where('store', '^(?!cart$|checkout$|login$|register$|password|email|verify-email|thank-you$).+')
    ->name('shop.index');

Route::get('/{store:slug}/producto/{product}', [ShopController::class, 'show'])
    ->where('store', '^(?!cart$|checkout$|login$|register$|password|email|verify-email|thank-you$).+')
    ->name('shop.show');

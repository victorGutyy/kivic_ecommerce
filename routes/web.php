<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::view('/', 'welcome');


Route::middleware(['auth'])->group(function(){
Route::get('/dashboard', function(){ return view('dashboard'); })->name('dashboard');
Route::resource('products', ProductController::class);
});


// Tienda pública básica
Route::get('/{store:slug}', [ProductController::class, 'publicIndex'])->name('store.home');
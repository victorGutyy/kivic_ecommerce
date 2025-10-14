<?php
namespace App\Http\Controllers;


use App\Models\{Store, Product};


class ShopController extends Controller
{
public function index(Store $store)
{
$products = $store->products()->with('images')->where('active', true)->paginate(12);
return view('shop.index', compact('store','products'));
}


public function show(Store $store, Product $product)
{
abort_unless($product->store_id === $store->id, 404);
$product->load(['variants','images']);
return view('shop.show', compact('store','product'));
}
}
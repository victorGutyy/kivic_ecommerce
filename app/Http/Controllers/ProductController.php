<?php
namespace App\Http\Controllers;
use App\Models\{Product, Store};
use Illuminate\Http\Request;


class ProductController extends Controller {
public function index(){
$products = Product::latest()->paginate(15);
return view('products.index', compact('products'));
}
public function publicIndex(Store $store){
$products = $store->products()->with('variants')->where('active',true)->paginate(12);
return view('shop.index', compact('store','products'));
}
}
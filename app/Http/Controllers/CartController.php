<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Variant;


class CartController extends Controller
{
public function view(Request $request)
{
$cart = session('cart', []); // [ [product_id, variant_id, title, price, qty], ... ]
$total = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
return view('shop.cart', compact('cart','total'));
}


public function add(Request $request)
{
$data = $request->validate([
'product_id' => 'required|integer',
'variant_id' => 'nullable|integer',
'title' => 'required|string',
'price' => 'required|integer',
'qty' => 'required|integer|min:1',
]);
$cart = session('cart', []);
$key = collect($cart)->search(fn($i) => $i['product_id']==$data['product_id'] && ($i['variant_id'] ?? null) == ($data['variant_id'] ?? null));
if ($key !== false) {
$cart[$key]['qty'] += $data['qty'];
} else {
$cart[] = $data;
}
session(['cart' => $cart]);
return redirect()->route('cart.view');
}


public function update(Request $request)
{
$items = $request->input('items', []); // [index => qty]
$cart = session('cart', []);
foreach ($items as $i => $qty) {
if (isset($cart[$i])) {
$cart[$i]['qty'] = max(1, (int)$qty);
}
}
session(['cart'=>$cart]);
return redirect()->route('cart.view');
}


public function remove(Request $request)
{
$i = (int) $request->input('index');
$cart = session('cart', []);
if (isset($cart[$i])) unset($cart[$i]);
session(['cart'=>array_values($cart)]);
return redirect()->route('cart.view');
}
}
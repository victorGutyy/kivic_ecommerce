<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\{Order, OrderItem};


class CheckoutController extends Controller
{
public function create(Request $request)
{
$cart = session('cart', []);
abort_if(empty($cart), 400, 'Carrito vacío');


$subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
$shipping = 0; // tarifa fija demo
$total = $subtotal + $shipping;


$order = Order::create([
'store_id' => 1, // demo
'customer_id' => null,
'status' => 'paid',
'subtotal' => $subtotal,
'shipping' => $shipping,
'total' => $total,
'payment_status' => 'paid',
]);


foreach ($cart as $i) {
OrderItem::create([
'order_id' => $order->id,
'product_id' => $i['product_id'],
'variant_id' => $i['variant_id'] ?? null,
'qty' => $i['qty'],
'unit_price' => $i['price'],
'line_total' => $i['price'] * $i['qty'],
]);
}


session()->forget('cart');
return redirect()->route('checkout.thankyou', $order);
}


public function thankyou(Order $order)
{
return view('shop.thank-you', compact('order'));
}
}
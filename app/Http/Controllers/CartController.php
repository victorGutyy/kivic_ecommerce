<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // GET /cart
    public function view(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        // Totales (en pesos)
        $subtotal = collect($cart)->sum(fn ($i) => (int)$i['price'] * (int)$i['quantity']);
        $iva      = (int) round($subtotal * 0.19);   // 19%
        $shipping = 0;                               // MVP
        $total    = $subtotal + $iva + $shipping;

        $fmt = fn (int $v) => '$ ' . number_format($v, 0, ',', '.');

        return view('shop.cart', compact('cart', 'subtotal', 'iva', 'shipping', 'total', 'fmt'));
    }

    // POST /cart/add/{product}
    public function add(Request $request, Product $product)
    {
        $qty  = max(1, (int)$request->input('qty', 1));
        $cart = $request->session()->get('cart', []);

        // 1 sola línea por producto (clave = id)
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $qty;
        } else {
            $img = optional($product->images->first())->src ?? asset('assets/tienda1.png');
            $cart[$product->id] = [
                'id'       => $product->id,
                'title'    => $product->title,
                'price'    => (int) $product->price,   // en pesos
                'image'    => $img,
                'quantity' => $qty,
            ];
        }

        $request->session()->put('cart', $cart);

        return back();
    }

    // POST /cart/update
    public function update(Request $request)
    {
        $id   = (int) $request->input('product_id');
        $qty  = max(1, (int) $request->input('qty', 1));
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $qty;
            $request->session()->put('cart', $cart);
        }

        return back();
    }

    // POST /cart/remove
    public function remove(Request $request)
    {
        $id   = (int) $request->input('product_id');
        $cart = $request->session()->get('cart', []);

        unset($cart[$id]);
        $request->session()->put('cart', $cart);

        return back();
    }

    // POST /cart/clear
    public function clear(Request $request)
    {
        $request->session()->forget('cart');

        return back();
    }
}

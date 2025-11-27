<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // GET /cart
    public function view(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        // Tienda a la que pertenece este carrito (si existe)
        $storeId = $request->session()->get('cart_store_id');
        $store   = $storeId ? Store::find($storeId) : null;

        // Totales (en pesos)
        $subtotal = collect($cart)->sum(fn ($i) => (int)$i['price'] * (int)$i['quantity']);
        $iva      = (int) round($subtotal * 0.19);   // 19%
        $shipping = 0;                               // MVP
        $total    = $subtotal + $iva + $shipping;

        $fmt = fn (int $v) => '$ ' . number_format($v, 0, ',', '.');

        return view('shop.cart', compact(
            'cart',
            'subtotal',
            'iva',
            'shipping',
            'total',
            'fmt',
            'store'          // 👈 muy importante para el layout.shop
        ));
    }

    // POST /cart/add/{product}
    public function add(Request $request, Product $product)
    {
        $qty  = max(1, (int)$request->input('qty', 1));
        $cart = $request->session()->get('cart', []);

        $productStoreId   = $product->store_id;
        $currentCartStore = $request->session()->get('cart_store_id');

        // Si el carrito ya tiene productos de otra tienda, lo reiniciamos (MVP)
        if ($currentCartStore && $currentCartStore !== $productStoreId) {
            $cart = [];
        }

        // Asociar el carrito a la tienda de este producto
        $request->session()->put('cart_store_id', $productStoreId);

        if (isset($cart[$product->id])) {
            // Si ya existe en el carrito, solo sumamos cantidad
            $cart[$product->id]['quantity'] += $qty;
        } else {
            $firstImage = $product->images->first();
            $imgPath    = $firstImage->url ?? null; // guardamos solo la ruta relativa

            $cart[$product->id] = [
                'id'       => $product->id,
                'store_id' => $productStoreId,
                'title'    => $product->title,
                'price'    => (int) $product->price,   // en pesos normales
                'image'    => $imgPath,                // ej: "products/archivo.jpg"
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

        // Si ya no quedan items en el carrito, olvidar también la tienda
        if (empty($cart)) {
            $request->session()->forget('cart_store_id');
        }

        $request->session()->put('cart', $cart);

        return back();
    }

    // POST /cart/clear
    public function clear(Request $request)
    {
        $request->session()->forget(['cart', 'cart_store_id']);

        return back();
    }
}

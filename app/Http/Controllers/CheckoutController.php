<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    // Crea Order e inicia flujo ePayco (auto-post)
    public function create(Request $request)
    {
        // 1) Obtener carrito
        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Tu carrito está vacío.');
        }

        // 2) Tienda
        $store = Store::where('slug', $request->route('store')->slug ?? 'moda-basica')->firstOrFail();

        // 3) Totales en PESOS (enteros)
        //    OJO: en tu carrito los precios están en pesos y la cantidad es "quantity"
        $subtotal = (int) collect($cart)->sum(function ($i) {
            $unit = (int)($i['price'] ?? 0);       // pesos
            $qty  = (int)($i['quantity'] ?? 1);
            return $unit * $qty;                   // pesos
        });

        $tax      = (int) round($subtotal * 0.19);           // pesos
        $shipping = ($subtotal < 200_000) ? 12_000 : 0;      // pesos
        $total    = $subtotal + $tax + $shipping;            // pesos

        // 4) Crear Order (la tabla usa *_cents)
        $ref = 'KIVIC-'.now()->format('YmdHis').'-'.Str::upper(Str::random(6));

        $order = Order::create([
            'store_id'        => $store->id,
            'user_id'         => auth()->id(),
            'reference'       => $ref,
            'status'          => 'pending',
            'customer_name'   => auth()->user()->name  ?? null,
            'email'           => auth()->user()->email ?? null,
            'subtotal_cents'  => $subtotal * 100,
            'tax_cents'       => $tax * 100,
            'shipping_cents'  => $shipping * 100,
            'total_cents'     => $total * 100,
            'currency'        => 'COP',
            'payment_gateway' => 'epayco',
        ]);

        // 5) Items -> coincidir EXACTAMENTE con la migración:
        //     qty, unit_price_cents, total_cents
        foreach ($cart as $line) {
            $qty  = (int)($line['quantity'] ?? 1);
            $unit = (int)($line['price'] ?? 0) * 100; // a centavos
            $totalLine = $unit * $qty;

            OrderItem::create([
                'order_id'          => $order->id,
                'product_id'        => $line['id'] ?? null,
                'title'             => $line['title'] ?? '',
                'qty'               => $qty,
                'unit_price_cents'  => $unit,
                'total_cents'       => $totalLine,
            ]);
        }

        // 6) Preparar redirección a ePayco (usa montos en pesos)
        $epayco = [
            'p_cust_id_cliente' => env('EPAYCO_P_CUST_ID_CLIENTE'),
            'p_key'              => env('EPAYCO_P_KEY'),
            'public_key'         => env('EPAYCO_PUBLIC_KEY'),
            'amount'             => number_format($total, 0, '.', ''), // p. ej. "95800"
            'currency'           => 'COP',
            'description'        => 'Pago del carrito',
            'reference'          => $ref,
            'test'               => env('EPAYCO_TEST', 1) ? 'true' : 'false',
            'response'           => env('EPAYCO_RESPONSE_URL'),
            'confirmation'       => env('EPAYCO_CONFIRM_URL'),
            'name_billing'       => auth()->user()->name  ?? 'Cliente',
            'email_billing'      => auth()->user()->email ?? 'test@example.com',
        ];

        // Firma MD5: md5(p_cust_id_cliente ^ p_key ^ reference ^ amount ^ currency)
        $epayco['signature'] = md5(
            $epayco['p_cust_id_cliente'].'^'.
            $epayco['p_key'].'^'.
            $epayco['reference'].'^'.
            $epayco['amount'].'^'.
            $epayco['currency']
        );

        // 7) Auto-post al checkout de ePayco
        return view('payments.epayco-checkout', compact('epayco', 'order'));
    }
}

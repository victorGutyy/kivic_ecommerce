<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PaymentController extends Controller
{
    // 1) Respuesta para el usuario (landing)
    public function epaycoResponse(Request $request)
    {
        // ePayco envía varios campos vía GET/POST; tomamos la referencia (x_ref_payco o x_id_invoice/p_id_invoice)
        $ref = $request->input('x_id_invoice') ?? $request->input('p_id_invoice') ?? $request->input('x_extra1') ?? $request->input('x_ref_payco');
        if (!$ref) {
            return view('shop.thank-you', ['order' => 'desconocido']);
        }

        $order = Order::where('reference', $ref)->first();

        return view('shop.thank-you', ['order' => $order?->reference ?? $ref]);
    }

    // 2) Confirmación (webhook) – AQUÍ validamos firma y aplicamos pago + rebaja de stock
    public function epaycoConfirm(Request $request)
    {
        // Campos típicos ePayco confirm: https://docs.epayco.co/
        $x_ref_payco   = $request->input('x_ref_payco');
        $x_transaction = $request->input('x_transaction_id');
        $x_amount      = $request->input('x_amount');
        $x_currency    = $request->input('x_currency_code');
        $x_signature   = $request->input('x_signature');
        $x_response    = $request->input('x_response');  // Aprobada/Rechazada/Pendiente
        $x_motivo      = $request->input('x_response_reason_text');
        $x_id_invoice  = $request->input('x_id_invoice');

        // Recalcular firma local
        $p_cust_id_cliente = env('EPAYCO_P_CUST_ID_CLIENTE');
        $p_key             = env('EPAYCO_P_KEY');
        $signLocal = md5($p_cust_id_cliente.'^'.$p_key.'^'.$x_ref_payco.'^'.$x_transaction.'^'.$x_amount.'^'.$x_currency);

        // Encontrar el pedido por referencia
        $order = Order::where('reference', $x_id_invoice)->first();
        if (!$order) { return response('order not found', 404); }

        // Guarda payload para auditoría
        $order->payment_payload = $request->all();

        if (hash_equals($signLocal, $x_signature) && strtolower($x_response) === 'aprobada') {
            // Marcar pagado
            $order->status      = 'paid';
            $order->payment_ref = $x_ref_payco ?: $x_transaction;
            $order->paid_at     = Carbon::now();

            // Rebajar stock
            foreach ($order->items as $it) {
                Product::where('id', $it->product_id)->decrement('stock', $it->qty);
            }

            // (Opcional) limpiar carrito por email/sesión si hay relación
        } elseif (strtolower($x_response) === 'rechazada') {
            $order->status = 'failed';
        } else {
            $order->status = 'pending';
        }

        $order->save();

        // ePayco espera 200
        return response('ok', 200);
    }
}

<x-guest-layout>
<div class="max-w-xl mx-auto p-6 text-center">
<h1 class="text-2xl font-bold mb-2">¡Gracias por tu compra!</h1>
<p class="mb-6"># Pedido: {{ $order->id }} — Total: ${{ number_format($order->total/100,2) }}</p>
<a href="/" class="text-indigo-600 underline">Volver a la tienda</a>
</div>
</x-guest-layout>
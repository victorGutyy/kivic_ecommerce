<x-guest-layout>
<div class="max-w-4xl mx-auto p-6">
<h1 class="text-2xl font-bold mb-4">Carrito</h1>


<form method="POST" action="{{ route('cart.update') }}">
@csrf
<div class="bg-white rounded shadow overflow-hidden">
<table class="min-w-full text-sm">
<thead class="bg-gray-50">
<tr>
<th class="text-left px-4 py-2">Producto</th>
<th class="text-left px-4 py-2">Precio</th>
<th class="text-left px-4 py-2">Cantidad</th>
<th class="text-right px-4 py-2">Subtotal</th>
<th></th>
</tr>
</thead>
<tbody>
@forelse($cart as $i => $item)
<tr class="border-t">
<td class="px-4 py-2">{{ $item['title'] }}</td>
<td class="px-4 py-2">${{ number_format($item['price']/100,2) }}</td>
<td class="px-4 py-2">
<input type="number" name="items[{{ $i }}]" value="{{ $item['qty'] }}" min="1" class="w-20 border rounded px-2 py-1">
</td>
<td class="px-4 py-2 text-right">${{ number_format(($item['price']*$item['qty'])/100,2) }}</td>
<td class="px-4 py-2 text-right">
<form method="POST" action="{{ route('cart.remove') }}">
@csrf
<input type="hidden" name="index" value="{{ $i }}">
<button class="text-red-600">Eliminar</button>
</form>
</td>
</tr>
@empty
<tr><td colspan="5" class="px-4 py-6 text-center text-gray-500">Carrito vacío</td></tr>
@endforelse
</tbody>
</table>
</div>
<div class="mt-4 flex items-center justify-between">
<button class="px-4 py-2 border rounded">Actualizar cantidades</button>
<div class="text-xl font-semibold">Total: ${{ number_format($total/100,2) }}</div>
</div>
</form>


@if(count($cart))
<form method="POST" action="{{ route('checkout.create') }}" class="mt-4 text-right">
@csrf
<button class="bg-emerald-600 text-white px-4 py-2 rounded">Finalizar compra</button>
</form>
@endif
</div>
</x-guest-layout>
<x-guest-layout>
<div class="max-w-5xl mx-auto p-6 grid md:grid-cols-2 gap-6">
@php $img = $product->images->first()->url ?? asset('assets/demo/tshirt_white.jpg'); @endphp
<img src="{{ $img }}" alt="{{ $product->title }}" class="w-full rounded">


<div>
<h1 class="text-2xl font-bold mb-2">{{ $product->title }}</h1>
<div class="text-lg text-gray-700 mb-4">${{ number_format($product->price/100,2) }}</div>
<p class="text-gray-600 mb-4">{{ $product->description }}</p>


@if($product->variants->count())
<form method="POST" action="{{ route('cart.add') }}" class="space-y-3">
@csrf
<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="hidden" name="title" value="{{ $product->title }}">
<input type="hidden" name="price" value="{{ $product->price }}">


<label class="block text-sm">Variante</label>
<select name="variant_id" class="border rounded px-3 py-2 w-full">
@foreach($product->variants as $v)
<option value="{{ $v->id }}">
{{ $v->size ?? 'Talla única' }} / {{ $v->color ?? '-' }} — Stock: {{ $v->stock }}
</option>
@endforeach
</select>


<div>
<label class="block text-sm">Cantidad</label>
<input type="number" name="qty" min="1" value="1" class="border rounded px-3 py-2 w-24">
</div>


<button class="bg-indigo-600 text-white px-4 py-2 rounded">Agregar al carrito</button>
</form>
@else
<form method="POST" action="{{ route('cart.add') }}" class="space-y-3">
@csrf
<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="hidden" name="title" value="{{ $product->title }}">
<input type="hidden" name="price" value="{{ $product->price }}">
<input type="hidden" name="qty" value="1">
<button class="bg-indigo-600 text-white px-4 py-2 rounded">Agregar al carrito</button>
</form>
@endif
</div>
</div>
</x-guest-layout>
<x-guest-layout>
<div class="max-w-6xl mx-auto p-6">
<h1 class="text-2xl font-bold mb-4">{{ $store->name }}</h1>
<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
@foreach($products as $p)
<a href="{{ route('shop.show', [$store, $p]) }}" class="border rounded-lg overflow-hidden bg-white hover:shadow">
@php $img = $p->images->first()->url ?? asset('assets/demo/tshirt_white.jpg'); @endphp
<img src="{{ $img }}" alt="{{ $p->title }}" class="w-full h-40 object-cover">
<div class="p-3">
<div class="font-semibold">{{ $p->title }}</div>
<div class="text-sm text-gray-600">${{ number_format($p->price/100,2) }}</div>
</div>
</a>
@endforeach
</div>
<div class="mt-6">{{ $products->links() }}</div>
</div>
</x-guest-layout>
<x-guest-layout>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-bold mb-6">{{ $store->name }}</h1>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach($products as $p)
        <a href="{{ route('shop.show', [$store, $p]) }}" class="bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden">
          <img src="{{ asset($p->images->first()->url ?? 'assets/demo/tshirt_white.jpg') }}" class="w-full h-56 object-cover" alt="{{ $p->title }}">
          <div class="p-4">
            <div class="font-semibold">{{ $p->title }}</div>
            <div class="text-sm text-gray-600">${{ number_format($p->price/100,2) }}</div>
          </div>
        </a>
      @endforeach
    </div>
    <div class="mt-8">{{ $products->links() }}</div>
  </div>
</x-guest-layout>

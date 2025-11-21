@extends('layouts.shop')

@section('content')

{{-- 🔹 CONTENEDOR PRINCIPAL CON THEME --}}
<div class="product-view-page theme-{{ $theme ?? 'kivic-classic' }}">

@php
  // Portada del producto (con respaldo por si no tiene imágenes asociadas)
  $cover = $product->images->first()->url ?? 'assets/tienda1.png';
@endphp

<nav class="pv-breadcrumbs container">
  <a href="{{ route('shop.index', ['store'=>$store->slug]) }}">← Volver a la tienda</a>
</nav>

<div class="product-view container">

  {{-- Galería --}}
  <div class="pv-gallery">
    <img class="pv-cover" src="{{ asset($cover) }}" alt="{{ $product->title }}">

    @if($product->images->count() > 1)
      <div class="pv-thumbs">
        @foreach($product->images as $img)
          <img class="pv-thumb"
               src="{{ asset($img->url) }}"
               alt="Miniatura"
               data-big="{{ asset($img->url) }}">
        @endforeach
      </div>
    @endif
  </div>

  {{-- Info --}}
  <div class="pv-info">
    <h1 class="pv-title">{{ $product->title }}</h1>
    <div class="pv-price">$ {{ number_format($product->price/100, 2) }}</div>

    @if($product->description)
      <p class="pv-desc">{{ $product->description }}</p>
    @endif

    <form action="{{ route('cart.add') }}" method="POST" class="pv-buy">
      @csrf
      <input type="hidden" name="product_id" value="{{ $product->id }}">

      <label class="pv-qtylabel">Cantidad</label>
      <div class="pv-qty">
        <button type="button" class="qbtn -dec" aria-label="Reducir">−</button>
        <input type="number" name="qty" value="1" min="1" step="1" inputmode="numeric">
        <button type="button" class="qbtn -inc" aria-label="Aumentar">+</button>
      </div>

      <button type="submit" class="btn btn--primary pv-add">Agregar al carrito</button>
    </form>

    <ul class="pv-bullets">
      <li>Pagos seguros</li>
      <li>Envíos a todo el país</li>
      <li>Soporte KIVIC</li>
    </ul>
  </div>

</div> {{-- product-view --}}

</div> {{-- product-view-page + theme --}}
{{-- 🔹 FIN DEL WRAPPER DEL THEME --}}

{{-- JS mínimo para galería y cantidad --}}
<script>
document.addEventListener('click', (e) => {
  if (e.target.matches('.pv-thumb')) {
    const big = e.target.dataset.big;
    const cover = document.querySelector('.pv-cover');
    if (big && cover) cover.src = big;
  }
  if (e.target.matches('.qbtn')) {
    const input = e.target.closest('.pv-qty').querySelector('input[name="qty"]');
    const delta = e.target.classList.contains('-inc') ? 1 : -1;
    const next = Math.max(1, (parseInt(input.value||'1',10) + delta));
    input.value = next;
  }
});
</script>

@endsection

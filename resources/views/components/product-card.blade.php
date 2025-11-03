@php
  // Imagen: toma la primera del producto o un placeholder
  $img = $p->images->first()->src ?? asset('assets/tienda1.png');

  // Precio en pesos (guardado como entero en tu DB)
  $precio = '$ ' . number_format((int)$p->price, 0, ',', '.');

  // Enlace a la ficha del producto (opcional)
  $showUrl = route('shop.show', ['store' => $store->slug ?? 'moda-basica', 'product' => $p->id]);
@endphp

<article class="card">
  <a href="{{ $showUrl }}" class="card__img">
    <img src="{{ $img }}" alt="{{ $p->title }}" loading="lazy">
    @if($p->created_at && $p->created_at->gt(now()->subDays(7)))
      <span class="badge badge--new">Nuevo</span>
    @endif
  </a>

  <div class="card__body">
    <h3 class="card__title">
      <a href="{{ $showUrl }}">{{ $p->title }}</a>
    </h3>

    <div class="card__price">{{ $precio }}</div>

    {{-- Botón para agregar al carrito (qty = 1 por defecto) --}}
    <form action="{{ route('cart.add', $p) }}" method="POST" class="card__actions">
      @csrf
      <input type="hidden" name="qty" value="1">
      <button type="submit" class="btn btn--primary">Agregar</button>
    </form>
  </div>
</article>

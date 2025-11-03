@php
  $img   = optional($p->images->first())->src ?? asset('assets/demo/placeholder.png');
  $price = '$ '.number_format((int)$p->price, 0, ',', '.');
  $show  = route('shop.show', ['store'=>$store->slug ?? 'moda-basica','product'=>$p->id]);
@endphp

<article class="product">
  <a href="{{ $show }}" class="product__cover" aria-label="Ver {{ $p->title }}">
    @if($p->created_at->gt(now()->subDays(7)))
      <span class="badge--new">Nuevo</span>
    @endif>
    <img src="{{ $img }}" alt="{{ $p->title }}" class="product__img" loading="lazy">
  </a>

  <div class="product__body">
    <h3 class="product__title"><a href="{{ $show }}">{{ $p->title }}</a></h3>
    <div class="product__price">{{ $price }}</div>

    <form action="{{ route('cart.add', $p) }}" method="POST" class="product__actions">
      @csrf
      <input type="hidden" name="qty" value="1">
      <button type="submit" class="btn btn--primary btn--full">Agregar</button>
    </form>
  </div>
</article>

@extends('layouts.shop')

@section('content')
<div class="shop-layout">
  {{-- Sidebar filtros (maqueta MVP) --}}
  <aside class="shop-filters">
    <h3>Filtros</h3>

    <details open>
      <summary>Categorías</summary>
      <ul class="filter-list">
        @foreach($categories as $cat)
          <li>
            <a href="{{ request()->fullUrlWithQuery(['cat'=>$cat]) }}"
               class="{{ request('cat')===$cat ? 'is-active' : '' }}">
              {{ ucfirst($cat) }}
            </a>
          </li>
        @endforeach
      </ul>
    </details>

    <details>
      <summary>Precio</summary>
      <form method="GET" class="price-form">
        <input type="number" name="min" placeholder="Mín" value="{{ request('min') }}">
        <input type="number" name="max" placeholder="Máx" value="{{ request('max') }}">
        <button type="submit">Aplicar</button>
      </form>
    </details>

    <details>
      <summary>Ordenar</summary>
      <ul class="filter-list">
        <li><a href="{{ request()->fullUrlWithQuery(['sort'=>'new']) }}">Más nuevos</a></li>
        <li><a href="{{ request()->fullUrlWithQuery(['sort'=>'price_asc']) }}">Precio ↑</a></li>
        <li><a href="{{ request()->fullUrlWithQuery(['sort'=>'price_desc']) }}">Precio ↓</a></li>
      </ul>
    </details>
  </aside>

  <section class="shop-main">
    {{-- Píldoras de categorías rápidas --}}
    <div class="cat-pills">
      @foreach($categories as $cat)
        <a href="{{ request()->fullUrlWithQuery(['cat'=>$cat]) }}"
           class="pill {{ request('cat')===$cat ? 'active' : '' }}">
          {{ ucfirst($cat) }}
        </a>
      @endforeach
      @if(request('cat') || request('q') || request('min') || request('max'))
        <a href="{{ route('shop.index',['store'=>$store->slug ?? 'moda-basica']) }}" class="pill clear">Limpiar</a>
      @endif
    </div>

    {{-- Grid de productos --}}
    <div class="product-grid">
      @forelse($products as $p)
        @include('components.product-card', ['p'=>$p])
      @empty
        <div class="empty">
          No encontramos resultados @if(request('q')) para “{{ request('q') }}” @endif
        </div>
      @endforelse
    </div>

    {{-- Paginación --}}
    <div class="pagination">
      {{ $products->withQueryString()->links() }}
    </div>
  </section>
</div>
@endsection

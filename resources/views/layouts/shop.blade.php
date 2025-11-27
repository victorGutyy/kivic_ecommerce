<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
    {{ $title ?? (isset($store) ? ($store->brand_name ?? $store->name).' · KIVIC' : 'KIVIC Commerce') }}
  </title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('css/kivic.css') }}?v={{ filemtime(public_path('css/kivic.css')) }}">
</head>

<body class="store-layout">

  @php
      use Illuminate\Support\Str;

      // ¿Estamos en contexto de tienda?
      $hasStore = isset($store);

      // Carrito (lo calculamos una sola vez)
      $cartCount = collect(session('cart', []))->sum('quantity');

      // Lógica de logo
      if ($hasStore) {
          // demo = id 1 (puedes cambiarlo a slug si quieres)
          $isDemo = $store->id === 1;

          if ($isDemo) {
              // La tienda demo sí muestra el logo KIVIC
              $logo = asset('assets/Kivic-logo.png');
          } elseif ($store->logo_path) {
              // Tiendas reales con logo propio
              $logo = asset('storage/'.$store->logo_path);
          } else {
              // Sin logo → placeholder
              $logo = null;
          }
      } else {
          // Páginas sin tienda (cart, checkout, etc.)
          $isDemo = false;
          $logo = asset('assets/Kivic-logo.png');
      }
  @endphp

  {{-- Topbar (tienda real o vista genérica de KIVIC) --}}
  <header class="shopbar">
    <div class="shopbar__inner container">

      {{-- Marca / logo --}}
      <a href="{{ $hasStore ? route('shop.index', ['store' => $store->slug]) : url('/') }}"
         class="shopbar__brand">

        @if($logo)
            <img src="{{ $logo }}"
                 alt="{{ $hasStore ? ($store->brand_name ?? $store->name) : 'KIVIC Commerce' }}"
                 class="shopbar__logo">
        @else
            <div class="store-logo-placeholder">
                @if($hasStore)
                    {{ Str::upper(Str::substr($store->brand_name ?? $store->name, 0, 1)) }}
                @else
                    K
                @endif
            </div>
        @endif

        <span>
            {{ $hasStore ? ($store->brand_name ?? $store->name) : 'KIVIC Commerce' }}
        </span>
      </a>

      {{-- Buscador --}}
      <form method="GET" class="shopbar__search">
        <input name="q"
               value="{{ request('q') }}"
               placeholder="¿Qué estás buscando?"
               aria-label="Buscar">
        <button type="submit">Buscar</button>
      </form>

      {{-- NAVBAR DERECHA --}}
      <nav class="shopbar__links" style="display:flex;gap:16px;align-items:center">

        @if($hasStore)
            <a href="{{ route('shop.index', ['store' => $store->slug]) }}">Categorías</a>
        @endif

        <a href="{{ route('cart.view') }}"
           class="cart-link"
           style="position:relative;display:inline-flex;align-items:center;gap:.5rem">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#374151" stroke-width="1.8">
            <circle cx="10" cy="20" r="1"/>
            <circle cx="18" cy="20" r="1"/>
            <path d="M2 3h3l3 12h10l2-8H6"/>
          </svg>
          <span class="cart-count">{{ $cartCount }}</span>
        </a>

        @auth
          <a href="{{ route('dashboard') }}">Panel</a>
        @else
          <a href="{{ route('login') }}">Ingresar</a>
        @endauth
      </nav>
    </div>
  </header>

  <main class="shop-page container">
    @yield('content')
  </main>

  {{-- Botón flotante de carrito --}}
  <a href="{{ route('cart.view') }}" class="cart-fab" aria-label="Ver carrito">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
      <circle cx="10" cy="20" r="1"/>
      <circle cx="18" cy="20" r="1"/>
      <path d="M2 3h3l3 12h10l2-8H6"/>
    </svg>
    @if($cartCount)
      <span class="cart-fab__count">{{ $cartCount }}</span>
    @endif
  </a>

  {{-- Footer propio de la tienda --}}
@include('components.store-footer')

</body>
</html>

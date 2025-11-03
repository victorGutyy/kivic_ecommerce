<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'KIVIC · Tienda demo' }}</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('css/kivic.css') }}?v={{ filemtime(public_path('css/kivic.css')) }}">
</head>

<body>
  {{-- Topbar tienda --}}
  <header class="shopbar">
    <div class="shopbar__inner container">
      <a href="{{ route('home') }}" class="shopbar__brand">
        <img src="{{ asset('assets/Kivic-logo.png') }}" alt="KIVIC" class="shopbar__logo">
        <span>KIVIC</span>
      </a>

      <form method="GET" class="shopbar__search">
        <input name="q" value="{{ request('q') }}" placeholder="¿Qué estás buscando?" aria-label="Buscar">
        <button type="submit">Buscar</button>
      </form>

      {{-- NAVBAR DERECHA --}}
    @php
      $cartCount = collect(session('cart', []))->sum('quantity');
    @endphp

<nav class="shopbar__links">
  <a href="{{ route('shop.index', ['store' => $store->slug ?? 'moda-basica']) }}">Categorías</a>
  <a href="{{ route('cart.view') }}" class="cart-link">
    🛒 <span class="cart-count">{{ $cartCount }}</span>
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

  @include('partials.footer') {{-- footer global de KIVIC --}}
</body>
</html>

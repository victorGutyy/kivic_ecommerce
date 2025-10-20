<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name','BIENVENIDOS A KIVIC E-Commerce') }}</title>

  <!-- Fuente -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <!-- Aquí se carga app.css (que a su vez importa custom.css) -->
  @vite(['resources/css/app.css','resources/js/app.js'])
 <link rel="stylesheet" href="{{ asset('css/kivic.css') }}?v={{ filemtime(public_path('css/kivic.css')) }}">
</head>
<body>
  {{-- NAVBAR (estilo Jumpseller) --}}
<nav class="topbar">
  <div class="container topbar__inner">
    {{-- Brand --}}
    <a href="{{ route('home') }}" class="topbar__brand">
      <img src="{{ asset('assets/Kivic-logo.png') }}" alt="KIVIC" class="topbar__logo">
      <span class="topbar__brandname">KIVIC</span>
    </a>

    {{-- Toggle mobile (checkbox hack, no JS) --}}
    <input id="nav-toggle" type="checkbox" class="topbar__toggle" />
    <label for="nav-toggle" class="topbar__burger" aria-label="Abrir menú">
      <span></span><span></span><span></span>
    </label>

    {{-- Menu principal --}}
    <ul class="topbar__menu">
      <li class="has-dropdown">
        <a href="#">Servicios</a>
        <ul class="dropdown">
          <li><a href="#">Diseño de tienda</a></li>
          <li><a href="#">Integraciones</a></li>
          <li><a href="#">Soporte & asistencia</a></li>
        </ul>
      </li>

      <li class="has-dropdown">
        <a href="#">Contenido</a>
        <ul class="dropdown">
          <li><a href="{{ route('shop.index',['store'=>'moda-basica']) }}">Tienda demo</a></li>
          <li><a href="#">Guías</a></li>
          <li><a href="#">Blog</a></li>
        </ul>
      </li>

      <li><a href="#precios">Precios</a></li>
    </ul>

    {{-- Acciones derecha --}}
    <div class="topbar__actions">
      @guest
        @if (Route::has('login'))
          <a href="{{ route('login') }}" class="topbar__link">Ingresar</a>
        @endif
        @if (Route::has('register'))
          <a href="{{ route('register') }}" class="topbar__cta">CREAR TIENDA</a>
        @endif
      @else
        <a href="{{ route('dashboard') }}" class="topbar__link">Panel</a>
      @endguest
    </div>
  </div>
</nav>

  <main class="page">
    @yield('content')
  </main>

  <footer>
    <p>
      KIVIC E-Commerce © {{ date('Y') }} | Hecho con ❤️ para pymes y emprendedores.<br>
      <a href="#">Facebook</a> • <a href="#">Instagram</a> • <a href="#">YouTube</a>
    </p>
  </footer>
</body>
</html>

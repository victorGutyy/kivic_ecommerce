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

 <footer class="kivic-footer">
  <div class="footer-container">
    
    <!-- Logo + redes -->
    <div class="footer-brand">
      <img src="{{ asset('assets/kivic-logo1.png') }}" alt="KIVIC logo" class="footer-logo">
      <p class="footer-slogan">Innovamos tu comercio digital</p>

     <div class="footer-socials">
  <a href="#" aria-label="Facebook">
    <img src="{{ asset('assets/Facebook.png') }}" alt="Facebook">
  </a>
  <a href="#" aria-label="Instagram">
    <img src="{{ asset('assets/instagram.png') }}" alt="Instagram">
  </a>
  <a href="#" aria-label="X (Twitter)">
    <img src="{{ asset('assets/x.png') }}" alt="X">
  </a>
  <a href="#" aria-label="YouTube">
    <img src="{{ asset('assets/youtube.png') }}" alt="YouTube">
  </a>
</div>
</div> 

    <!-- Columnas -->
    <div class="footer-columns">
      <div class="footer-col">
        <h4>E-Commerce</h4>
        <ul>
          <li><a href="#">Medios de pago</a></li>
          <li><a href="#">Pasarelas locales</a></li>
          <li><a href="#">Métodos de envío</a></li>
          <li><a href="#">Plantillas KIVIC</a></li>
          <li><a href="#">Aplicaciones</a></li>
          <li><a href="#">Categorías populares</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Vende en todas partes</h4>
        <ul>
          <li><a href="#">Facebook / Instagram Shop</a></li>
          <li><a href="#">Google Commerce</a></li>
          <li><a href="#">WhatsApp Business</a></li>
          <li><a href="#">Mercado Libre</a></li>
          <li><a href="#">Tiendas locales</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>KIVIC</h4>
        <ul>
          <li><a href="#">Sobre nosotros</a></li>
          <li><a href="#">Precios</a></li>
          <li><a href="#">Afiliados</a></li>
          <li><a href="#">Equipo</a></li>
          <li><a href="#">Contáctanos</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Contenido</h4>
        <ul>
          <li><a href="#">Centro de ayuda</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Diseño</a></li>
          <li><a href="#">Webinars</a></li>
          <li><a href="#">API</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Línea inferior -->
  <div class="footer-bottom">
    <p>© {{ date('Y') }} KIVIC E-Commerce. Todos los derechos reservados.</p>
    <div class="footer-links">
      <a href="#">Privacidad</a>
      <a href="#">Seguridad</a>
      <a href="#">Términos</a>
    </div>
  </div>
</footer>

</body>
</html>

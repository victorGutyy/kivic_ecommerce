<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'KIVIC E-Commerce') }}</title>

    {{-- Tailwind / app --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Estilos KIVIC --}}
    <link rel="stylesheet" href="{{ asset('css/kivic.css') }}?v={{ filemtime(public_path('css/kivic.css')) }}">
</head>

<body class="auth-body">

  <!-- NAVBAR SUPERIOR -->
  <nav class="auth-navbar">
    <div class="auth-navbar-inner">

      {{-- Logo + país --}}
      <a href="{{ route('home') }}" class="auth-brand">
          <img src="{{ asset('assets/Kivic-logo.png') }}" alt="KIVIC" class="auth-brand-logo">

          <span class="auth-made-co">
              Hecho en Colombia
              <img src="{{ asset('assets/flag-colombia.jpg') }}" alt="Colombia" class="auth-flag">
          </span>
      </a>

      {{-- Acciones --}}
      <div class="auth-nav-actions">
        @guest
            <a href="{{ route('login') }}" class="auth-link">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="auth-btn">Crear cuenta</a>
        @endguest

        @auth
            <a href="{{ route('dashboard') }}" class="auth-btn">Ir al panel</a>
        @endauth
      </div>
    </div>
  </nav>

  <!-- CONTENIDO (CENTRADO) -->
  <main class="auth-wrapper">
      {{ $slot }}
  </main>

  <!-- FOOTER -->
  <footer class="auth-footer">
      <p>© {{ date('Y') }} KIVIC E-Commerce — Hecho para pymes.</p>
      <a href="{{ route('shop.index',['store'=>'moda-basica']) }}" class="auth-footer-link">Tienda demo</a>
  </footer>

</body>
</html>

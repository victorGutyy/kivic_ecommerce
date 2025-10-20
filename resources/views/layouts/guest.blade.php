<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name','KIVIC') }}</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-b from-gray-50 to-white text-gray-800">

  <!-- NAVBAR -->
  <nav class="sticky top-0 z-40 border-b bg-white/80 backdrop-blur">
    <div class="max-w-7xl mx-auto h-16 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
      <a href="{{ route('home') }}" class="flex items-center gap-3">
        <img src="{{ asset('assets/kivic-logo.png') }}" class="h-8 w-auto" alt="KIVIC">
        <span class="text-lg font-extrabold tracking-tight">KIVIC <span class="text-indigo-600">E-Commerce</span></span>
      </a>

      <div class="hidden md:flex items-center gap-4">
        <a href="{{ route('shop.index',['store'=>'moda-basica']) }}" class="text-sm font-semibold hover:text-indigo-600">Ver tienda demo</a>
        @guest
          <a href="{{ route('login') }}" class="text-sm font-medium px-4 py-2 rounded border hover:bg-gray-50">Iniciar sesión</a>
          <a href="{{ route('register') }}" class="text-sm font-medium px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">Crear cuenta</a>
        @endguest
        @auth
          <a href="{{ route('dashboard') }}" class="text-sm font-medium px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">Ir al panel</a>
        @endauth>
      </div>
    </div>
  </nav>

  <!-- CONTENIDO -->
  <main>
    {{ $slot }}
  </main>

  <!-- FOOTER -->
  <footer class="mt-20 border-t">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-sm text-gray-500 flex items-center justify-between">
      <p>© {{ date('Y') }} KIVIC E-Commerce — Hecho para pymes.</p>
      <a href="{{ route('shop.index',['store'=>'moda-basica']) }}" class="hover:text-indigo-600">Tienda demo</a>
    </div>
  </footer>
</body>
</html>

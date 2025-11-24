<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'KIVIC Panel')</title>

    {{-- Fuente KIVIC (igual que en la landing) --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Estilos exclusivos del panel --}}
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
</head>

<body class="kp-panel-body">


<header class="kp-header">
    <div class="kp-logo">
        <span class="kp-logo-badge">K</span>
        <span class="kp-logo-text">KIVIC Commerce</span>
    </div>

    <nav class="kp-top-nav">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('stores.create.step1') }}">Crear tienda</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
    @csrf
    <button type="submit" class="kp-btn-ghost" style="margin-left:16px;">
        Salir
    </button>
</form>

    </nav>
</header>

<div class="kp-shell">
    <aside class="kp-sidebar">
        <h3 class="kp-sidebar-title">Panel</h3>
        <ul>
            <li><a href="{{ route('dashboard') }}">🏠 Inicio</a></li>
            <li><a href="{{ route('stores.create.step1') }}">➕ Crear tienda</a></li>
            {{-- aquí luego añadimos “Branding”, “Productos”, etc. --}}
        </ul>
    </aside>

    <main class="kp-content">
        <h1 class="kp-page-title">@yield('page_title', 'Dashboard')</h1>

        @yield('content')
    </main>
</div>

</body>
</html>

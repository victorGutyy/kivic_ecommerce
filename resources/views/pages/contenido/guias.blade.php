@extends('layouts.public')

@section('content')

{{-- HERO --}}
<section class="kv-hero-light">
    <div class="kv-container hero-grid">

        <div class="hero-text">
            <h1 class="hero-title">Guías KIVIC</h1>
            <p class="hero-subtitle">Aprende, construye y escala tu negocio digital.</p>

            <p class="hero-desc">
                Explora guías prácticas diseñadas para ayudarte a dominar el comercio electrónico,
                desde configuración inicial hasta estrategias avanzadas de marketing.
            </p>
        </div>

        <div class="hero-img">
            <img src="{{ asset('assets/hero-guias.png') }}" alt="Guías KIVIC">
        </div>

    </div>
</section>

{{-- LISTADO DE GUÍAS --}}
<section class="kv-section">
    <div class="kv-container kv-grid">

        <a class="kv-card guide-card">
            <h3>Crear tu primera tienda</h3>
            <p>Aprende a configurar tu tienda desde cero.</p>
        </a>

        <a class="kv-card guide-card">
            <h3>Métodos de pago</h3>
            <p>Activa pasarelas como Wompi, PayU y Mercado Pago.</p>
        </a>

        <a class="kv-card guide-card">
            <h3>Diseño & Branding</h3>
            <p>Construye una identidad visual profesional.</p>
        </a>

        <a class="kv-card guide-card">
            <h3>Marketing Digital</h3>
            <p>Promociona tu tienda y atrae nuevos clientes.</p>
        </a>

        <a class="kv-card guide-card">
            <h3>Google & Meta Commerce</h3>
            <p>Conecta tu catálogo a Instagram, Facebook y Google.</p>
        </a>

        <a class="kv-card guide-card">
            <h3>SEO para tiendas</h3>
            <p>Mejora tu posicionamiento en buscadores.</p>
        </a>

    </div>
</section>

{{-- CTA --}}
<section class="kv-cta">
    <div class="kv-container">
        <h2>Aprende todo lo que necesitas para tener éxito</h2>
        <a href="{{ route('register') }}" class="cta-button">Crear tienda</a>
    </div>
</section>

@endsection

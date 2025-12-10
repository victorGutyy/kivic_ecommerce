@extends('layouts.public')

@section('content')

{{-- HERO --}}
<section class="kv-hero-light">
    <div class="kv-container hero-grid">

        <div class="hero-text">
            <h1 class="hero-title">Blog KIVIC</h1>
            <p class="hero-subtitle">Ideas, tendencias y estrategias para emprendedores digitales.</p>

            <p class="hero-desc">
                Nuestro blog reúne artículos, novedades y consejos para ayudarte a escalar tu negocio
                online de manera inteligente.
            </p>
        </div>

        <div class="hero-img">
            <img src="{{ asset('assets/hero-blog.png') }}" alt="Blog KIVIC">
        </div>

    </div>
</section>

{{-- POST CARDS --}}
<section class="kv-section">
    <div class="kv-container kv-grid">

        <div class="kv-card blog-card">
            <h3>Cómo duplicar tus ventas en 30 días</h3>
            <p>Estrategias comprobadas y aplicables a cualquier industria.</p>
        </div>

        <div class="kv-card blog-card">
            <h3>Qué plantilla elegir para tu tienda</h3>
            <p>Guía para escoger el diseño perfecto según tu negocio.</p>
        </div>

        <div class="kv-card blog-card">
            <h3>Los 5 errores más comunes al vender online</h3>
            <p>Evítalos y acelera el crecimiento de tu tienda.</p>
        </div>

    </div>
</section>

{{-- CTA --}}
<section class="kv-cta">
    <div class="kv-container">
        <h2>Muy pronto podrás explorar cientos de artículos</h2>
        <a href="{{ route('register') }}" class="cta-button">Crear tienda</a>
    </div>
</section>

@endsection

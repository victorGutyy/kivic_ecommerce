@extends('layouts.public')

@section('content')

{{-- HERO --}}
<section class="kv-hero-light">
    <div class="kv-container hero-grid">

        <div class="hero-text">
            <h1 class="hero-title">Tienda Demo KIVIC</h1>
            <p class="hero-subtitle">Explora una tienda real construida en nuestra plataforma.</p>

            <p class="hero-desc">
                Descubre cómo luce una tienda profesional creada con KIVIC. Navega productos, prueba
                el carrito y vive la experiencia de tus clientes.
            </p>

            <a href="{{ route('shop.index',['store'=>'moda-basica']) }}" class="cta-button">
                Ver tienda demo
            </a>
        </div>

        <div class="hero-img">
            <img src="{{ asset('assets/hero-demo.png') }}" alt="Tienda demo">
        </div>

    </div>
</section>

{{-- SECCIÓN DE BENEFICIOS --}}
<section class="kv-section-light">
    <div class="kv-container benefits-grid">

        <div>
            <h2 class="kv-title">¿Qué puedes explorar?</h2>

            <ul class="kv-list-check">
                <li>Catálogo de productos</li>
                <li>Proceso de compra real</li>
                <li>Diseño adaptable a móviles</li>
                <li>Carrito y checkout optimizados</li>
                <li>Velocidad y fluidez profesional</li>
            </ul>
        </div>

        <div>
            <img src="{{ asset('assets/demo-preview.png') }}" class="benefit-img">
        </div>

    </div>
</section>

@endsection

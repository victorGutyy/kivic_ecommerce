@extends('layouts.public')

@section('content')

{{-- HERO --}}
<section class="kv-hero-light">
    <div class="kv-container hero-grid">

        <div class="hero-text">
            <h1 class="hero-title">Diseño de Tienda Profesional</h1>
            <p class="hero-subtitle">Construye una marca moderna y memorable en minutos.</p>

            <p class="hero-desc">
                Con KIVIC puedes crear tiendas visualmente impactantes, rápidas, optimizadas para SEO
                y listas para vender. Nuestro sistema combina plantillas premium con personalización
                completa, garantizando que tu tienda se vea única y profesional.
            </p>
        </div>

        <div class="hero-img">
            <img src="{{ asset('assets/soporte tecnico.jpg') }}" alt="Diseño de tienda KIVIC">
        </div>

    </div>
</section>

{{-- BENEFICIOS DE DISEÑO --}}
<section class="kv-section-light">
    <div class="kv-container benefits-grid">

        {{-- TARJETA IZQUIERDA --}}
        <div class="design-list-box">
            <ul class="kv-list-check">
                <li>Plantillas premium exclusivas</li>
                <li>Diseños modernos listos para adaptarse a cualquier industria.</li>
                <li>Editor visual avanzado</li>
                <li>Modifica colores, fuentes, secciones y banners sin código.</li>
                <li>Optimización móvil</li>
                <li>Mayor velocidad y conversión en smartphones.</li>
                <li>SEO listo desde el inicio</li>
                <li>Tu tienda indexa correctamente en Google desde el primer día.</li>
                <li>Branding completo</li>
                <li>Diseño escalable</li>
            </ul>
        </div>

        {{-- IMAGEN DERECHA --}}
        <div>
            <img src="{{ asset('assets/diseño.jpg') }}" class="benefit-img">
        </div>

    </div>
</section>



{{-- CTA FINAL --}}
<section class="kv-cta">
    <div class="kv-container">
        <h2>Diseña tu tienda hoy mismo y empieza a vender</h2>
        <a href="{{ route('register') }}" class="cta-button">Crear tienda gratis</a>
    </div>
</section>

@endsection

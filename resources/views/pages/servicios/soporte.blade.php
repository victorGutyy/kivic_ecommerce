@extends('layouts.public')

@section('content')

{{-- HERO --}}
<section class="kv-hero-light">
    <div class="kv-container hero-grid">
        
        <div class="hero-text">
            <h1 class="hero-title">Soporte & Asistencia</h1>
            <p class="hero-subtitle">Estamos contigo en cada paso de tu crecimiento.</p>

            <p class="hero-desc">
                Nuestro equipo te acompaña desde la creación de tu tienda hasta la operación diaria.
                Resolución rápida, soporte humano real, guías actualizadas y asistencia prioritaria
                según tu plan.
            </p>
        </div>

        <div class="hero-img">
            <img src="{{ asset('assets/hero-soporte.png') }}" alt="Soporte KIVIC">
        </div>

    </div>
</section>

{{-- TIPOS DE SOPORTE --}}
<section class="kv-section">
    <div class="kv-container kv-grid">
        
        <div class="kv-card">
            <h3>Soporte por correo y chat</h3>
            <p>Atención rápida para resolver dudas y ayudarte a avanzar.</p>
        </div>

        <div class="kv-card">
            <h3>Onboarding asistido</h3>
            <p>Te guiamos en la configuración inicial de tu tienda.</p>
        </div>

        <div class="kv-card">
            <h3>Diagnóstico de tienda</h3>
            <p>Revisión técnica y sugerencias para mejorar rendimiento.</p>
        </div>

        <div class="kv-card">
            <h3>Soporte prioritario</h3>
            <p>Para planes avanzados, con tiempos de respuesta preferenciales.</p>
        </div>

    </div>
</section>

{{-- MÁS DETALLES --}}
<section class="kv-section-light">
    <div class="kv-container benefits-grid">

        <div>
            <h2 class="kv-title">Un equipo listo para ayudarte</h2>

            <ul class="kv-list-check">
                <li>Guías paso a paso siempre actualizadas</li>
                <li>Acompañamiento técnico especializado</li>
                <li>Asistencia en configuración avanzada</li>
                <li>Soporte humano en español</li>
                <li>Revisión de integraciones y pagos</li>
            </ul>
        </div>

        <div>
            <img src="{{ asset('assets/hero-soporte2.png') }}" class="benefit-img">
        </div>

    </div>
</section>

{{-- CTA --}}
<section class="kv-cta">
    <div class="kv-container">
        <h2>¿Necesitas ayuda? Estamos listos para apoyarte</h2>
        <a href="{{ route('register') }}" class="cta-button">Crear tienda</a>
    </div>
</section>

@endsection

@extends('layouts.public')

@section('content')

{{-- ===========================
     HERO SECTION
=========================== --}}
<section class="kv-hero-light">
    <div class="kv-container hero-grid">

        <div class="hero-text">
            <h1 class="hero-title">Integraciones KIVIC</h1>
            <p class="hero-subtitle">
                Conecta tu tienda con herramientas profesionales que impulsan tus ventas.
            </p>
            <p class="hero-desc">
                KIVIC integra pagos, envíos, redes sociales y marketplaces para que puedas
                escalar tu negocio sin complicaciones técnicas.
            </p>
        </div>

        <div class="hero-img">
            <img src="{{ asset('assets/conexion.jpg') }}" alt="Integraciones KIVIC">
        </div>

    </div>
</section>


{{-- ===========================
     INTEGRACIONES (GRID)
=========================== --}}
<section class="kv-section">
    <div class="kv-container integraciones-header">
        <h2 class="kv-title">Principales Integraciones</h2>
        <p class="kv-subtitle">Todas las herramientas que necesitas para vender sin límites.</p>


        <div class="kv-grid">
            <div class="kv-card">
                <img src="{{ asset('assets/pasarelas-de-pago.jpg') }}" class="kv-icon">
                <h3>Pasarelas de pago</h3>
                <p>Mercado Pago, PayU, Wompi, Stripe</p>
            </div>

            <div class="kv-card">
                <img src="{{ asset('assets/envios.jpg') }}" class="kv-icon">
                <h3>Métodos de envío</h3>
                <p>Coordinadora, Envía, Servientrega</p>
            </div>

            <div class="kv-card">
                <img src="{{ asset('assets/f-i.jpg') }}" class="kv-icon">
                <h3>Facebook & Instagram Shop</h3>
                <p>Conecta tu catálogo en minutos</p>
            </div>

            <div class="kv-card">
                <img src="{{ asset('assets/google-commerce.jpg') }}" class="kv-icon">
                <h3>Google Commerce</h3>
                <p>Google Shopping y anuncios inteligentes</p>
            </div>

            <div class="kv-card">
                <img src="{{ asset('assets/whatsapp.jpg') }}" class="kv-icon">
                <h3>WhatsApp Business API</h3>
                <p>Vende y gestiona pedidos desde WhatsApp</p>
            </div>

            <div class="kv-card">
                <img src="{{ asset('assets/mercado-libre.jpg') }}" class="kv-icon">
                <h3>Mercado Libre</h3>
                <p>Sincronización de productos y pedidos</p>
            </div>
        </div>
    </div>
</section>


{{-- ===========================
     BENEFICIOS
=========================== --}}
<section class="kv-section-light">
    <div class="kv-container benefits-grid">

        <div>
            <h2 class="kv-title">¿Por qué integrar tu tienda?</h2>
            <ul class="kv-list-check">
                <li>Automatizas procesos clave de tu negocio</li>
                <li>Escalas ventas sin aumentar carga operativa</li>
                <li>Conectas tu tienda a canales de alto tráfico</li>
                <li>Mejoras la experiencia de compra del cliente</li>
                <li>Centralizas pagos, envíos y marketing</li>
            </ul>
        </div>

        <div>
            <img src="{{ asset('assets/hero-beneficios.png') }}" class="benefit-img">
        </div>

    </div>
</section>


{{-- ===========================
     CTA FINAL
=========================== --}}
<section class="kv-cta">
    <div class="kv-container">
        <h2>Haz crecer tu negocio con integraciones avanzadas</h2>
        <a href="{{ route('register') }}" class="cta-button">Crear mi tienda gratis</a>
    </div>
</section>

@endsection

@extends('layouts.panel')

@section('title', 'Dashboard - KIVIC')
@section('page_title', 'Tu panel KIVIC')

@section('content')
    {{-- Bloque de bienvenida / CTA --}}
    <section class="kp-card kp-card-primary kp-card-horizontal">
        <div>
            <h2>Administra tus tiendas en un solo lugar</h2>
            <p>Crea nuevas tiendas, revisa su estado y entra a verlas tal como las ven tus clientes.</p>

            <a href="{{ route('stores.create.step1') }}" class="kp-btn kp-btn-light">
                Crear una nueva tienda
            </a>
        </div>
        <div class="kp-card-badge">
            <span>⚡</span>
            <small>Listo en minutos</small>
        </div>
    </section>

    {{-- Listado de tiendas del usuario --}}
    <section class="kp-section">
        <h2 class="kp-section-title">Mis tiendas</h2>

        @if($stores->isEmpty())
            <p class="kp-empty">
                Aún no tienes tiendas creadas. Empieza creando tu primera tienda.
            </p>
        @else
            <div class="kp-grid">
                @foreach($stores as $store)
                    <article class="kp-card">
                        <h3 class="kp-store-name">{{ $store->name }}</h3>
                        <p class="kp-store-slug">{{ $store->slug }}</p>

                        <p class="kp-store-meta">
                            Plan: <strong>{{ strtoupper($store->plan ?? 'free') }}</strong><br>
                            Tema inicial:
                            <strong>{{ $store->theme ?? 'kivic-classic' }}</strong>
                        </p>

                        <div class="kp-store-actions">
                            <a href="{{ route('shop.index', $store->slug) }}" class="kp-btn">
                                Ver tienda pública
                            </a>
                            <a href="{{ route('stores.products.index', $store) }}" class="kp-btn">
                                Productos
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection

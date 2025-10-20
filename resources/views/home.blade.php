@extends('layouts.public')

@section('content')
<section class="hero">
  

  <h1 class="title">BIENVENIDOS A KIVIC E-COMMERCE</h1>

  <p class="lead">
    Para nuestro grupo de trabajo es un honor que deposite sus sueños en nuestra plataforma y así juntos los podamos cumplir.
  </p>

  <h2 class="subtitle">Crea tu tienda en minutos</h2>

  <form method="GET" action="{{ route('register') }}" class="email-form">
    <input type="email" name="email" placeholder="Ingresa tu correo para crear tu tienda" required class="input">
    <button type="submit" class="btn">Continuar</button>
  </form>

  <div class="hero-shot">
    <img src="{{ asset('assets/tienda2.png') }}" alt="Vista de tienda KIVIC">
  </div>
</section>

 {{-- =========================
     SECCIÓN 1 – Construye tu marca (texto izq / imagen der)
     ========================= --}}
<section class="section">
  <div class="container grid-2">
    <div class="text">
      <h2 class="section__title">Construye tu marca con KIVIC</h2>
      <p class="section__lead">
        Diseña una tienda que se vea profesional desde el día uno. Con KIVIC puedes empezar con
        plantillas rápidas y, cuando lo necesites, ir más allá con personalizaciones finas.
      </p>

      <ul class="kivic-list">
        <li>Temas gratuitos y de pago optimizados para móvil</li>
        <li>Editor visual para ajustar colores, tipografías y bloques</li>
        <li>Acceso a código para cambios avanzados cuando lo necesites</li>
        <li>Dominio personalizado y SEO listo</li>
        <li>Multi-idioma y multimoneda</li>
      </ul>

      <a href="{{ route('register') }}" class="btn-primary">Más sobre diseño</a>
    </div>

    <figure class="kivic-figure media">
      <img src="{{ asset('assets/tienda1.png') }}" alt="Diseño de tienda con KIVIC">
    </figure>
  </div>
</section>

{{-- =========================
     SECCIÓN 2 – Vende donde compran (imagen izq / texto der)
     ========================= --}}
<section class="section section--alt">
  <div class="container grid-2 grid-2--flip">
    <figure class="kivic-figure media">
      <img src="{{ asset('assets/pagina3.png') }}" alt="Canales de venta KIVIC">
    </figure>

    <div class="text">
      <h2 class="section__title">Vende donde tus clientes compran</h2>
      <p class="section__lead">
        Amplía tu presencia y asegúrate de que tus productos se encuentren. Con KIVIC, publicar en distintos
        canales de venta es cuestión de minutos.
      </p>

      <ul class="kivic-list">
        <li>Facebook / Instagram Shopping</li>
        <li>Google Merchant / Google Shopping</li>
        <li>WhatsApp Business (catálogo y pedidos)</li>
        <li>Marketplaces locales (según país)</li>
      </ul>

      <a href="{{ route('shop.index',['store'=>'moda-basica']) }}" class="btn-primary">Ver tienda demo</a>
    </div>
  </div>
</section>

{{-- =========================
     SECCIÓN 3 – Plataforma moderna (texto izq / imagen der)
     ========================= --}}
<section class="section">
  <div class="container grid-2">
    <div class="text">
      <h2 class="section__title">Una plataforma moderna creada para durar</h2>
      <p class="section__lead">
        Cada país tiene necesidades distintas. Por eso KIVIC integra medios de pago y envíos locales
        para que puedas cobrar y despachar sin complicaciones.
      </p>

      <ul class="kivic-list">
        <li>Pagos en línea con proveedores locales e internacionales</li>
        <li>Integraciones de envío con rastreo</li>
        <li>Panel simple con reportes de ventas</li>
        <li>Seguridad TLS/HTTPS y mejores prácticas</li>
      </ul>

      <a href="{{ route('register') }}" class="btn-primary">Haz un recorrido</a>
    </div>

    <figure class="kivic-figure media">
      <img src="{{ asset('assets/pagina2.png') }}" alt="Integraciones KIVIC">
    </figure>
  </div>
</section>


@endsection

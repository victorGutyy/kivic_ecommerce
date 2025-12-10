@extends('layouts.public')

@section('content')

<section class="kv-section">
    <div class="kv-container">

        {{-- Título general de la página --}}
        <h1 class="kv-title">@yield('title')</h1>

        {{-- Subtítulo opcional --}}
        @hasSection('subtitle')
            <p class="kv-subtitle">@yield('subtitle')</p>
        @endif

        {{-- Contenido principal --}}
        <div class="kv-body">
            @yield('body')
        </div>

    </div>
</section>

@endsection

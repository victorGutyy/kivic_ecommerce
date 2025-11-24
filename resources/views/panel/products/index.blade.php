@extends('layouts.panel')

@section('title', 'Productos de '.$store->name)
@section('page_title', 'Productos de '.$store->name)

@section('content')
    @if(session('status'))
        <div class="kp-card" style="margin-bottom:16px;">
            {{ session('status') }}
        </div>
    @endif

    <div class="kp-card" style="margin-bottom:16px;">
        <a href="{{ route('stores.products.create', $store) }}" class="kp-btn kp-btn-light">
            + Agregar producto
        </a>
    </div>

    <div class="kp-grid">
        @forelse($products as $product)
            <article class="kp-card">
                <h3>{{ $product->title }}</h3>
                <p style="font-size:.9rem;margin-bottom:4px;">
                    ${{ number_format($product->price / 100, 0, ',', '.') }}
                </p>
                <p style="font-size:.8rem;color:#9ca3af;">
                    {{ Str::limit($product->description, 80) }}
                </p>
            </article>
        @empty
            <p>No tienes productos aún.</p>
        @endforelse
    </div>
@endsection

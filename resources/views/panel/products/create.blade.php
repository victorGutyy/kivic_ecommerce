@extends('layouts.panel')

@section('title', 'Nuevo producto - '.$store->name)
@section('page_title', 'Nuevo producto para '.$store->name)

@section('content')
    <section class="kp-card kp-form-card kp-form-card-narrow">
        @if ($errors->any())
            <div class="kp-alert kp-alert-error">
                <strong>Revisa estos campos:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('stores.products.store', $store) }}"
              method="post"
              enctype="multipart/form-data"
              class="kp-form">

            @csrf

            <div class="kp-field">
                <label for="title">Nombre del producto</label>
                <input
                    id="title"
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    required
                    placeholder="Ej: Camiseta básica unisex">
                <p class="kp-help">
                    Este será el nombre que verán tus clientes en la tienda.
                </p>
            </div>

            <div class="kp-field">
                <label for="description">Descripción</label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    placeholder="Describe las características, materiales, uso, etc.">{{ old('description') }}</textarea>
            </div>

            <div class="kp-field kp-field-inline">
                <div>
                    <label for="price">Precio</label>
                    <div class="kp-input-prefix">
                        <span class="kp-input-prefix-label">{{ $store->currency ?? 'COP' }}</span>
                        <input
                            id="price"
                            type="number"
                            step="0.01"
                            min="0"
                            name="price"
                            value="{{ old('price') }}"
                            required
                            placeholder="0.00">
                    </div>
                    <p class="kp-help">
                        Ingresa el precio final que verá el cliente (sin puntos).
                    </p>
                </div>

                <div class="kp-toggle">
                    <label for="active">Estado</label>
                    <div class="kp-toggle-row">
                        <input
                            id="active"
                            type="checkbox"
                            name="active"
                            value="1"
                            {{ old('active', true) ? 'checked' : '' }}>
                        <span>Producto activo y visible en la tienda</span>
                    </div>
                </div>
            </div>

            <div class="kp-field">
                <label for="image">Imagen principal</label>
                <input
                    id="image"
                    type="file"
                    name="image"
                    accept="image/*">
                <p class="kp-help">
                    Formatos recomendados: JPG o PNG, máximo 4 MB.
                </p>
            </div>

            <div class="kp-form-actions">
                <a href="{{ route('stores.products.index', $store) }}" class="kp-btn">
                    Cancelar
                </a>
                <button type="submit" class="kp-btn kp-btn-light">
                    Guardar producto
                </button>
            </div>
        </form>
    </section>
@endsection

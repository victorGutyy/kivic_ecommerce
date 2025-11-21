@extends('layouts.public')

@section('content')
    <div style="
        min-height: calc(100vh - 120px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 16px;
    ">
        <div style="
            width: 100%;
            max-width: 720px;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.2);
            border: 1px solid #c4b5fd;
            padding: 32px 40px;
        ">

            {{-- HEADER PASO 1 --}}
            <p style="font-size: 13px; font-weight: 600; color:#4c1d95; margin:0 0 4px 0;">
                Paso 1 de 3 · Datos básicos de tu tienda
            </p>

            <h1 style="font-size: 24px; font-weight: 800; color:#020617; margin:0 0 4px 0;">
                Crea tu tienda en KIVIC
            </h1>

            <p style="font-size: 14px; color:#111827; margin:0 0 20px 0;">
                Cuéntanos cómo se llama tu negocio y en qué país operas.
            </p>

            {{-- FORMULARIO --}}
            <form method="POST" action="{{ route('stores.store.step1') }}">
                @csrf

                {{-- Nombre de la tienda --}}
                <div style="margin-bottom: 16px;">
                    <label style="display:block; font-size:14px; font-weight:600; color:#020617; margin-bottom:4px;">
                        Nombre de la tienda <span style="color:#b91c1c">*</span>
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $data['name'] ?? '') }}"
                        placeholder="Ej: El Gangazo, Moda Básica, Mi Tienda Online"
                        required
                        style="
                            width:100%;
                            padding: 10px 12px;
                            font-size: 15px;
                            border-radius: 10px;
                            border: 1px solid #a855f7;
                            background:#ffffff;
                            color:#020617;
                            outline:none;
                        "
                    >
                    @error('name')
                        <p style="color:#b91c1c; font-size:12px; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- País --}}
                <div style="margin-bottom: 16px;">
                    <label style="display:block; font-size:14px; font-weight:600; color:#020617; margin-bottom:4px;">
                        País
                    </label>
                    <input
                        type="text"
                        value="CO"
                        disabled
                        style="
                            width:100%;
                            padding: 10px 12px;
                            font-size: 15px;
                            border-radius: 10px;
                            border: 1px solid #e5e7eb;
                            background:#f9fafb;
                            color:#6b7280;
                            outline:none;
                        "
                    >
                    <input type="hidden" name="country" value="CO">
                </div>

                {{-- Moneda --}}
                <div style="margin-bottom: 24px;">
                    <label style="display:block; font-size:14px; font-weight:600; color:#020617; margin-bottom:4px;">
                        Moneda
                    </label>
                    <input
                        type="text"
                        value="COP"
                        disabled
                        style="
                            width:100%;
                            padding: 10px 12px;
                            font-size: 15px;
                            border-radius: 10px;
                            border: 1px solid #e5e7eb;
                            background:#f9fafb;
                            color:#6b7280;
                            outline:none;
                        "
                    >
                    <input type="hidden" name="currency" value="COP">
                </div>

                {{-- CONTROLES --}}
                <div style="display:flex; align-items:center; justify-content:space-between; gap:12px;">
                    <a href="{{ route('home') }}"
                       style="font-size:13px; color:#4b5563; text-decoration:none;">
                        ← Volver a la página principal
                    </a>

                    <button type="submit"
                            style="
                                padding: 10px 20px;
                                border-radius: 999px;
                                border:none;
                                background:#4c1d95;
                                color:#ffffff;
                                font-size:14px;
                                font-weight:700;
                                cursor:pointer;
                                box-shadow:0 14px 30px rgba(76,29,149,0.35);
                            ">
                        Continuar con el paso 2
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

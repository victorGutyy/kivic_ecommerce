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

            {{-- HEADER PASO 2 --}}
            <p style="font-size: 13px; font-weight: 600; color:#4c1d95; margin:0 0 4px 0;">
                Paso 2 de 3 · Información de tu negocio
            </p>

            <h1 style="font-size: 24px; font-weight: 800; color:#020617; margin:0 0 4px 0;">
                Cuéntanos un poco más de tu marca
            </h1>

            <p style="font-size: 14px; color:#111827; margin:0 0 20px 0;">
                Estos datos nos ayudan a personalizar tu panel y la comunicación con tus clientes.
            </p>

            {{-- FORMULARIO --}}
            <form method="POST" action="{{ route('stores.store.step2') }}">
                @csrf

                {{-- Nombre de marca --}}
                <div style="margin-bottom: 16px;">
                    <label style="display:block; font-size:14px; font-weight:600; color:#020617; margin-bottom:4px;">
                        Nombre de marca (opcional)
                    </label>
                    <input
                        type="text"
                        name="brand_name"
                        value="{{ old('brand_name', $data['brand_name'] ?? '') }}"
                        placeholder="Ej: KIVIC Store, Moda Básica"
                        style="
                            width:100%;
                            padding: 10px 12px;
                            font-size: 15px;
                            border-radius: 10px;
                            border: 1px solid #d1d5db;
                            background:#ffffff;
                            color:#020617;
                            outline:none;
                        "
                    >
                </div>

                {{-- Industria --}}
                <div style="margin-bottom: 16px;">
                    <label style="display:block; font-size:14px; font-weight:600; color:#020617; margin-bottom:4px;">
                        Sector o industria (opcional)
                    </label>
                    <input
                        type="text"
                        name="industry"
                        value="{{ old('industry', $data['industry'] ?? '') }}"
                        placeholder="Ropa, Calzado, Tecnología, Belleza..."
                        style="
                            width:100%;
                            padding: 10px 12px;
                            font-size: 15px;
                            border-radius: 10px;
                            border: 1px solid #d1d5db;
                            background:#ffffff;
                            color:#020617;
                            outline:none;
                        "
                    >
                </div>

                {{-- Teléfono --}}
                <div style="margin-bottom: 16px;">
                    <label style="display:block; font-size:14px; font-weight:600; color:#020617; margin-bottom:4px;">
                        Teléfono de contacto (opcional)
                    </label>
                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $data['phone'] ?? '') }}"
                        placeholder="+57 300 000 0000"
                        style="
                            width:100%;
                            padding: 10px 12px;
                            font-size: 15px;
                            border-radius: 10px;
                            border: 1px solid #d1d5db;
                            background:#ffffff;
                            color:#020617;
                            outline:none;
                        "
                    >
                </div>

                {{-- WhatsApp --}}
                <div style="margin-bottom: 16px;">
                    <label style="display:block; font-size:14px; font-weight:600; color:#020617; margin-bottom:4px;">
                        WhatsApp (opcional)
                    </label>
                    <input
                        type="text"
                        name="whatsapp"
                        value="{{ old('whatsapp', $data['whatsapp'] ?? '') }}"
                        placeholder="+57 300 000 0000"
                        style="
                            width:100%;
                            padding: 10px 12px;
                            font-size: 15px;
                            border-radius: 10px;
                            border: 1px solid #d1d5db;
                            background:#ffffff;
                            color:#020617;
                            outline:none;
                        "
                    >
                </div>

                {{-- Instagram --}}
                <div style="margin-bottom: 16px;">
                    <label style="display:block; font-size:14px; font-weight:600; color:#020617; margin-bottom:4px;">
                        Instagram (opcional)
                    </label>
                    <input
                        type="text"
                        name="instagram"
                        value="{{ old('instagram', $data['instagram'] ?? '') }}"
                        placeholder="@tumarca"
                        style="
                            width:100%;
                            padding: 10px 12px;
                            font-size: 15px;
                            border-radius: 10px;
                            border: 1px solid #d1d5db;
                            background:#ffffff;
                            color:#020617;
                            outline:none;
                        "
                    >
                </div>

                {{-- Ciudad --}}
                <div style="margin-bottom: 24px;">
                    <label style="display:block; font-size:14px; font-weight:600; color:#020617; margin-bottom:4px;">
                        Ciudad (opcional)
                    </label>
                    <input
                        type="text"
                        name="city"
                        value="{{ old('city', $data['city'] ?? '') }}"
                        placeholder="Bogotá, Medellín, Cali..."
                        style="
                            width:100%;
                            padding: 10px 12px;
                            font-size: 15px;
                            border-radius: 10px;
                            border: 1px solid #d1d5db;
                            background:#ffffff;
                            color:#020617;
                            outline:none;
                        "
                    >
                </div>

                {{-- CONTROLES --}}
                <div style="display:flex; align-items:center; justify-content:space-between; gap:12px;">
                    <a href="{{ route('stores.create.step1') }}"
                       style="font-size:13px; color:#4b5563; text-decoration:none;">
                        ← Volver al paso 1
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
                        Continuar con el paso 3
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

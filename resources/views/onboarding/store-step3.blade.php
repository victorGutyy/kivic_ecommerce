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

            {{-- HEADER PASO 3 --}}
            <p style="font-size: 13px; font-weight: 600; color:#4c1d95; margin:0 0 4px 0;">
                Paso 3 de 3 · Plan y diseño de tu tienda
            </p>

            <h1 style="font-size: 24px; font-weight: 800; color:#020617; margin:0 0 4px 0;">
                Elige cómo quieres empezar
            </h1>

            <p style="font-size: 14px; color:#111827; margin:0 0 20px 0;">
                Selecciona un plan y una plantilla inicial. Podrás cambiar de plan o de diseño más adelante.
            </p>

            {{-- FORMULARIO --}}
            <form method="POST"
                  action="{{ route('stores.finish') }}"
                  enctype="multipart/form-data">
                @csrf

                {{-- PLANES --}}
                <div style="margin-bottom: 24px;">
                    <label style="display:block; font-size:14px; font-weight:700; color:#020617; margin-bottom:8px;">
                        Plan
                    </label>

                    <div style="display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:12px;">
                        @php
                            $currentPlan = old('plan', $data['plan'] ?? 'free');
                        @endphp

                        {{-- Free --}}
                        <label style="
                            border-radius:12px;
                            border:1px solid {{ $currentPlan === 'free' ? '#4c1d95' : '#e5e7eb' }};
                            padding:10px 12px;
                            cursor:pointer;
                            font-size:13px;
                        ">
                            <input type="radio" name="plan" value="free"
                                   {{ $currentPlan === 'free' ? 'checked' : '' }}
                                   style="margin-right:6px;">
                            <strong>Free</strong><br>
                            <span style="color:#6b7280;">Ideal para probar KIVIC</span>
                        </label>

                        {{-- Starter --}}
                        <label style="
                            border-radius:12px;
                            border:1px solid {{ $currentPlan === 'starter' ? '#4c1d95' : '#e5e7eb' }};
                            padding:10px 12px;
                            cursor:pointer;
                            font-size:13px;
                        ">
                            <input type="radio" name="plan" value="starter"
                                   {{ $currentPlan === 'starter' ? 'checked' : '' }}
                                   style="margin-right:6px;">
                            <strong>Starter</strong><br>
                            <span style="color:#6b7280;">Para pymes en crecimiento</span>
                        </label>

                        {{-- Pro --}}
                        <label style="
                            border-radius:12px;
                            border:1px solid {{ $currentPlan === 'pro' ? '#4c1d95' : '#e5e7eb' }};
                            padding:10px 12px;
                            cursor:pointer;
                            font-size:13px;
                        ">
                            <input type="radio" name="plan" value="pro"
                                   {{ $currentPlan === 'pro' ? 'checked' : '' }}
                                   style="margin-right:6px;">
                            <strong>Pro</strong><br>
                            <span style="color:#6b7280;">Funcionalidades avanzadas</span>
                        </label>
                    </div>
                    @error('plan')
                        <p style="color:#b91c1c; font-size:12px; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- TEMA --}}
                <div style="margin-bottom: 24px;">
                    <label style="display:block; font-size:14px; font-weight:700; color:#020617; margin-bottom:8px;">
                        Estilo inicial de tu tienda
                    </label>

                    @php
                        $currentTheme = old('theme', $data['theme'] ?? 'kivic-classic');
                    @endphp

                    <div style="display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:12px;">
                        @foreach($themes as $key => $label)
                            <label style="
                                border-radius:12px;
                                border:1px solid {{ $currentTheme === $key ? '#4c1d95' : '#e5e7eb' }};
                                padding:10px 12px;
                                cursor:pointer;
                                font-size:13px;
                            ">
                                <input type="radio" name="theme" value="{{ $key }}"
                                       {{ $currentTheme === $key ? 'checked' : '' }}
                                       style="margin-right:6px;">
                                <strong>{{ $label }}</strong><br>
                                <span style="color:#6b7280;">Plantilla lista para usar</span>
                            </label>
                        @endforeach
                    </div>
                    @error('theme')
                        <p style="color:#b91c1c; font-size:12px; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- LOGO DE LA TIENDA --}}
                <div style="margin-bottom: 24px;">
                    <label style="display:block; font-size:14px; font-weight:700; color:#020617; margin-bottom:8px;">
                        Logo de la tienda (opcional)
                    </label>

                    <input type="file" name="logo"
                           style="
                                display:block;
                                padding:10px;
                                border:1px solid #e5e7eb;
                                border-radius:12px;
                                width:100%;
                           ">

                    <p style="font-size: 12px; color:#6b7280; margin-top:6px;">
                        Formatos permitidos: JPG o PNG — Máximo 2 MB.
                    </p>

                    @error('logo')
                        <p style="color:#b91c1c; font-size:12px; margin-top:4px;">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- CONTROLES --}}
                <div style="display:flex; align-items:center; justify-content:space-between; gap:12px;">
                    <a href="{{ route('stores.create.step2') }}"
                       style="font-size:13px; color:#4b5563; text-decoration:none;">
                        ← Volver al paso 2
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
                        Crear tienda y finalizar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

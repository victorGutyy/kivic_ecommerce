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

            {{-- HEADER KIVIC --}}
            <div style="text-align: center; margin-bottom: 24px;">
                <div style="
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    padding: 6px 16px;
                    border-radius: 999px;
                    background: #f5f3ff;
                    border: 1px solid #a855f7;
                    margin-bottom: 12px;
                    font-size: 12px;
                    font-weight: 700;
                    letter-spacing: 0.18em;
                    text-transform: uppercase;
                    color: #581c87;
                ">
                    <span style="font-size: 18px;">🚀</span>
                    <span>Crea tu tienda en KIVIC</span>
                </div>

                <h1 style="
                    font-size: 32px;
                    line-height: 1.2;
                    font-weight: 800;
                    color: #020617;
                    margin: 0 0 8px 0;
                ">
                    Tu tienda online lista en solo
                    <span style="color: #4c1d95;">3 minutos</span>
                </h1>

                <p style="
                    font-size: 15px;
                    color: #111827;
                    max-width: 540px;
                    margin: 0 auto;
                ">
                    Construye tu marca con KIVIC. Diseña una tienda que se vea profesional desde el primer día,
                    sin necesidad de saber de programación.
                </p>
            </div>

            {{-- FORMULARIO --}}
            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Nombre --}}
                <div style="margin-bottom: 16px;">
                    <label style="display:block; font-size:14px; font-weight:600; color:#020617; margin-bottom:4px;">
                        Nombre completo o nombre del negocio
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Ej: Tienda KIVIC Store"
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

                {{-- Email --}}
                <div style="margin-bottom: 16px;">
                    <label style="display:block; font-size:14px; font-weight:600; color:#020617; margin-bottom:4px;">
                        Correo electrónico
                    </label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="tucorreo@negocio.com"
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
                    @error('email')
                        <p style="color:#b91c1c; font-size:12px; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div style="margin-bottom: 16px;">
                    <label style="display:block; font-size:14px; font-weight:600; color:#020617; margin-bottom:4px;">
                        Contraseña
                    </label>
                    <input
                        type="password"
                        name="password"
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
                    @error('password')
                        <p style="color:#b91c1c; font-size:12px; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm password --}}
                <div style="margin-bottom: 16px;">
                    <label style="display:block; font-size:14px; font-weight:600; color:#020617; margin-bottom:4px;">
                        Confirmar contraseña
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
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
                </div>

                {{-- Habeas Data --}}
                <div style="display:flex; align-items:flex-start; gap:8px; font-size:12px; color:#111827; margin-bottom:18px;">
                    <input
                        id="habeas_data"
                        type="checkbox"
                        name="habeas_data"
                        value="1"
                        required
                        style="
                            margin-top:3px;
                            width:14px;
                            height:14px;
                            border-radius:4px;
                            border:1px solid #4c1d95;
                        "
                    >
                    <label for="habeas_data">
                        Autorizo el tratamiento de mis datos por parte de
                        <span style="font-weight:700; color:#4c1d95;">KIVIC E-Commerce</span>,
                        conforme a la normativa colombiana y la Política de Tratamiento de Datos.
                    </label>
                </div>

                {{-- Botón --}}
                <button
                    type="submit"
                    style="
                        width:100%;
                        padding: 12px 16px;
                        border-radius: 999px;
                        border:none;
                        background:#4c1d95;
                        color:#ffffff;
                        font-size:16px;
                        font-weight:800;
                        cursor:pointer;
                        box-shadow:0 18px 40px rgba(76,29,149,0.45);
                    "
                >
                    Crear cuenta y continuar
                </button>

                {{-- Ya tienes cuenta --}}
                <p style="text-align:center; font-size:14px; color:#020617; margin-top:18px;">
                    ¿Ya tienes cuenta?
                    <a href="{{ route('login') }}" style="color:#4c1d95; font-weight:700; text-decoration:underline;">
                        Inicia sesión
                    </a>
                </p>
            </form>
        </div>
    </div>
@endsection

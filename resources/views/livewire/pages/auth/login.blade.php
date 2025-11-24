<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

// Usamos el layout "guest" de Breeze, que ya está preparado con {{ $slot }}
new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
};

?>

<div class="hero hero--auth">
    <section class="hero__card">
        {{-- Estado de sesión (mensajes tipo "Sesión cerrada", etc.) --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        {{-- Encabezado --}}
        <header class="hero__header">
            <p class="hero__pill">Bienvenido de nuevo</p>
            <h1>Inicia sesión en KIVIC</h1>
            <p class="hero__subtitle">
                Usa el correo y la contraseña que registraste al crear tu tienda.
            </p>
        </header>

        {{-- Formulario de login --}}
        <form wire:submit="login" class="hero__form">
            <!-- Email -->
            <div class="hero__field">
                <label for="email">Correo electrónico</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    wire:model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="tunegocio@correo.com"
                >
                @error('form.email')
                    <p class="hero__error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="hero__field">
                <label for="password">Contraseña</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    wire:model="form.password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                >
                @error('form.password')
                    <p class="hero__error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember me + enlace recuperar -->
            <div class="hero__row">
                <label class="hero__remember">
                    <input
                        id="remember"
                        type="checkbox"
                        wire:model="form.remember"
                        name="remember"
                    >
                    <span>Recordarme</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="hero__link" wire:navigate>
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <!-- Botón -->
            <button type="submit" class="hero__btn">
                Entrar al panel
            </button>

            <!-- Footer del formulario -->
            <p class="hero__footer-text">
                ¿Aún no tienes tienda?
                <a href="{{ route('register') }}" class="hero__link">
                    Crear tienda en KIVIC
                </a>
            </p>
        </form>
    </section>
</div>

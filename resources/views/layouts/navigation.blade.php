<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            {{-- IZQUIERDA: Nombre o Home --}}
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-xl font-bold text-indigo-600">
                    <span>KIVIC</span>
                </a>
            </div>

            {{-- DERECHA: Menú principal --}}
<div class="hidden sm:flex sm:items-center sm:ml-6 space-x-3">

    {{-- Links públicos (siempre visibles) --}}
    <a href="#servicios" class="text-sm text-gray-700 hover:text-indigo-600">Servicios</a>
    <a href="#contenido" class="text-sm text-gray-700 hover:text-indigo-600">Contenido</a>
    <a href="#precios"   class="text-sm text-gray-700 hover:text-indigo-600">Precios</a>

    @auth
        {{-- Usuario autenticado --}}
        <a href="{{ route('dashboard') }}"
           class="text-sm text-gray-700 hover:text-indigo-600">
            Panel
        </a>

        <a href="{{ route('stores.create.step1') }}"
           class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-full
                  border border-indigo-500 text-indigo-600 hover:bg-indigo-50">
            CREAR TIENDA
        </a>
    @else
        {{-- Invitado --}}
        <a href="{{ route('login') }}"
           class="text-sm text-gray-700 hover:text-indigo-600">
            Ingresar
        </a>

        <a href="{{ route('register') }}"
           class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-full
                  border border-lime-400 text-lime-600 hover:bg-lime-50">
            CREAR TIENDA
        </a>
    @endauth
</div>


            {{-- HAMBURGUESA (móvil) --}}
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- MENÚ MÓVIL --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700">Panel</a>
                <a href="{{ route('products.index') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700">Productos</a>
            @endauth
            <a href="{{ route('shop.index', ['store' => 'moda-basica']) }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700">Ver Tienda</a>
        </div>
    </div>
</nav>

{{-- Logo fijo esquina superior derecha --}}
<img
  src="{{ asset('assets/kivic-logo.png') }}"
  alt="KIVIC"
  class="fixed top-2 right-3 h-10 w-auto z-50 select-none pointer-events-none"
/>

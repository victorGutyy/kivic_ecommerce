<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tu panel KIVIC') }}
                </h2>
                <p class="text-sm text-gray-500">
                    Administra tus tiendas y empieza a vender en minutos.
                </p>
            </div>

            <a href="{{ route('stores.create.step1') }}"
               class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold
                      bg-indigo-600 text-white hover:bg-indigo-700 shadow-sm">
                + Crear nueva tienda
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($stores->isEmpty())
                {{-- Empty state cuando no hay tiendas --}}
                <div class="bg-white shadow-sm rounded-2xl p-8 text-center">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                        Aún no tienes ninguna tienda creada
                    </h3>
                    <p class="text-gray-500 mb-6">
                        Crea tu primera tienda en KIVIC E-Commerce y empieza a vender tus productos online.
                    </p>
                    <a href="{{ route('stores.create.step1') }}"
                       class="inline-flex items-center px-6 py-3 rounded-full text-sm font-semibold
                              bg-indigo-600 text-white hover:bg-indigo-700 shadow-md">
                        Crear mi primera tienda
                    </a>
                </div>
            @else
                {{-- Listado de tiendas del usuario --}}
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Mis tiendas
                    </h3>
                    <p class="text-sm text-gray-500">
                        Gestiona la configuración de tus tiendas o entra a ver cómo las ven tus clientes.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($stores as $store)
                        <div class="bg-white shadow-sm rounded-2xl p-5 flex flex-col justify-between">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">
                                    {{ $store->name }}
                                </h4>
                                <p class="text-sm text-gray-500 mb-2">
                                    {{ $store->slug }}
                                </p>

                                <p class="text-xs inline-flex items-center px-2 py-1 rounded-full
                                           bg-green-100 text-green-700 font-medium">
                                    Activa
                                </p>
                            </div>

                            <div class="mt-4 flex items-center justify-between gap-2">
                                <a href="{{ route('shop.index', ['store' => $store->slug]) }}"
                                   class="text-xs font-semibold text-indigo-600 hover:text-indigo-700">
                                    Ver tienda pública
                                </a>

                                {{-- Aquí más adelante puedes enlazar a un panel interno específico de la tienda --}}
                                {{-- <a href="{{ route('stores.manage', $store) }}" class="text-xs font-semibold text-gray-700">
                                    Administrar
                                </a> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

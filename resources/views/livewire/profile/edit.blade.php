<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mi perfil') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-6">
                <p class="text-gray-700">
                    Aquí va el formulario de edición de perfil. (En construcción)
                </p>

                <div class="border-t pt-4 text-sm text-gray-400">
                    Usuario: {{ $user->name }}<br>
                    Email: {{ $user->email }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

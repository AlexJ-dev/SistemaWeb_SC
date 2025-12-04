<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sagrado Corazón') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/modal-registro.js', 'resources/js/modal-editar.js', 'resources/js/usuarios.js', 'resources/js/ruta.js', 'resources/js/historiaClinica.js', 'resources/js/antecedenteMedico.js', 'resources/js/ubigeo.js', 'resources/js/empresa-modal.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="flex">
        <!-- Sidebar fijo -->
        <x-sidebar-clinico />

        <!-- Contenido principal con scroll -->
        <div class="flex-1 overflow-y-auto p-6">
            {{ $slot }}
        </div>

        {{-- Modal global de empresa (una sola vez) --}}
        <x-empresa-modal />
    </div>
    @yield('scripts')
</body>


</html>
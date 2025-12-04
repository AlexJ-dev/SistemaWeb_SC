@extends('layouts.app')

@section('title', 'Acceso restringido')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-lg rounded-lg p-8 text-center max-w-md">
        <h1 class="text-6xl font-bold text-red-700 mb-4">403</h1>
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Acceso restringido</h2>
        <p class="text-gray-600 mb-6">
            Lo sentimos, no cuentas con los permisos necesarios para acceder a esta sección del sistema.
        </p>
        <a href="{{ route('inicio') }}"
            class="px-6 py-2 bg-[#9C1C2A] text-white rounded hover:bg-[#b91c1c] transition">
            Volver al inicio
        </a>

    </div>
</div>
@endsection
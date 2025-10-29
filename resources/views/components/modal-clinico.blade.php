@props([
    'id', // ID único del modal
    'titulo', // Título del encabezado
    'boton' => 'Guardar', // Texto del botón principal
    'accion', // Ruta del formulario
    'metodo' => 'POST', // Método HTTP
])

<dialog id="{{ $id }}" class="rounded-lg shadow w-full max-w-4xl p-4 md:p-6">
    <form method="POST" action="{{ $accion }}" class="bg-white p-6 space-y-4">
        @csrf
        @if ($metodo !== 'POST')
            @method($metodo)
        @endif

        <h2 class="text-lg font-semibold text-[#4C4C4C]">{{ $titulo }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{ $slot }}
        </div>

        <div class="flex justify-end space-x-4 pt-2">
            <button type="button" onclick="document.getElementById('{{ $id }}').close()" class="text-[#4C4C4C] underline">Cancelar</button>
            <x-boton-clinico>{{ $boton }}</x-boton-clinico>
        </div>
    </form>
</dialog>

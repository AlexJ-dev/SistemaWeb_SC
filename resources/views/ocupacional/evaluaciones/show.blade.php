<x-clinico-layout>
    <x-encabezado-clinico />

    <div class="bg-white rounded shadow p-6">

        <h2 class="text-xl font-semibold mb-4">
            Evaluación – {{ $evaluacion->areaOcupacional->nombre }}
        </h2>

        {{-- Datos básicos --}}
        @include('evaluaciones.partials.header-info')

        {{-- Botón iniciar evaluación --}}
        @if($evaluacion->estado == 'pendiente')
            <form method="POST" action="{{ route('evaluaciones.iniciar', $evaluacion->id) }}">
                @csrf
                <button class="px-4 py-2 bg-blue-600 text-white rounded">
                    Iniciar Evaluación
                </button>
            </form>
        @endif

        {{-- FORMULARIO DEL ÁREA SEGÚN ID --}}
        @if($evaluacion->estado == 'en_proceso')
            
            @if($evaluacion->area_ocupacional_id == 1)
                @include('ocupacional.evaluaciones.admision')
            @endif

            
        @endif

    </div>
</x-clinico-layout>

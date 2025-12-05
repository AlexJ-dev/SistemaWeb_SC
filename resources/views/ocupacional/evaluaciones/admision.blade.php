<form action="{{ route('admision.update', $evaluacion->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="space-y-6 mt-4">

        <!-- Card: Ficha Ocupacional -->
        <div class="p-5 border rounded-lg shadow-sm bg-white">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">
                Ficha Ocupacional
            </h3>
            <p class="text-sm text-gray-600 mb-3">
                Información ocupacional registrada para el paciente.
            </p>

            @if ($evaluacion->fichaOcupacional)
                <a href="{{ route('ocupacional.fichas.editar', ['id' => $evaluacion->fichaOcupacional->id, 'from' => 'evaluaciones']) }}"
                   class="text-red-700 hover:text-red-900 hover:underline font-medium">
                    Editar Ficha
                </a>
            @else
                <a href="{{ route('ocupacional.fichas.crear', ['id' => $evaluacion->rutaMedica->id, 'from' => 'evaluaciones']) }}"
                   class="text-gray-700 hover:text-red-900 hover:underline font-medium">
                    Crear Ficha
                </a>
            @endif
        </div>

        <!-- Card: Historia Clínica -->
        <div class="p-5 border rounded-lg shadow-sm bg-white">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">
                Historia Clínica
            </h3>
            <p class="text-sm text-gray-600 mb-3">
                Registro clínico detallado del paciente.
            </p>

            @if ($evaluacion->rutaMedica && $evaluacion->rutaMedica->documento)
                <a href="{{ route('historiaClinica.editar', ['dni' => $evaluacion->rutaMedica->documento, 'from' => 'evaluaciones']) }}"
                   class="text-red-700 hover:text-red-900 hover:underline font-medium">
                    Editar Historia Clínica
                </a>
            @else
                <span class="text-gray-500">Documento no disponible</span>
            @endif
        </div>

        <!-- Card: Historia Ocupacional -->
        <div class="p-5 border rounded-lg shadow-sm bg-white">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">
                Historia Ocupacional
            </h3>
            <p class="text-sm text-gray-600 mb-3">
                Historial laboral y puestos desempeñados por el paciente.
            </p>

            <a href="{{ route('historia.index', ['paciente_id' => $evaluacion->rutaMedica->paciente->id, 'from' => 'evaluaciones']) }}"
               class="text-red-700 hover:text-red-900 hover:underline font-medium">
                Ver historial ocupacional
            </a>
        </div>

    </div>
</form>

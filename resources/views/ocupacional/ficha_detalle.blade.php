<x-clinico-layout>
    <x-encabezado-clinico />

    <div class="container mx-auto p-6 space-y-8">

        {{-- Ficha Ocupacional --}}
        <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="fas fa-file-medical text-[#9C1C2A]"></i>
                Ficha Ocupacional #{{ $ficha->numero_ficha }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                <p><strong>Nombres:</strong> {{ $ficha->paciente->nombres }}</p>
                <p><strong>Apellidos:</strong> {{ $ficha->paciente->apellidos }}</p>
                <p><strong>DNI:</strong> {{ $ficha->paciente->documento }}</p>
                <p><strong>Empresa:</strong> {{ $ficha->empresa }}</p>
                <p><strong>Tipo de Evaluación:</strong> {{ $ficha->tipo_evaluacion }}</p>
                <p><strong>Edad:</strong> {{ \Carbon\Carbon::parse($ficha->paciente->fecha_nacimiento)->age }} años</p>
            </div>

            <a href="{{ route('ocupacional.fichas.editar', ['id' => $ficha->id, 'from' => 'fichas.detalle', 'ficha' => $ficha->id]) }}"
                class="mt-6 inline-flex items-center bg-[#9C1C2A] text-white px-6 py-2 rounded-lg shadow hover:bg-[#7C1A24] transition">
                <i class="fas fa-edit mr-2"></i> Ver
            </a>
        </div>


        {{-- Historia Clínica --}}
        <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-100">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-stethoscope text-blue-600"></i>
                Historia Clínica
            </h3>

            @if($ficha->historiaClinica)
            <div class="space-y-2 text-gray-700">
                <p><strong>N° Historia:</strong> {{ $ficha->historiaClinica->numero_historia }}</p>
                <p><strong>Diagnóstico:</strong> {{ Str::limit($ficha->historiaClinica->diagnostico, 70) }}</p>
            </div>

            <a href="{{ route('historiaClinica.editar', [
                        'dni' => $ficha->paciente->documento,
                        'from' => 'fichas.detalle',
                        'ficha' => $ficha->id
                    ]) }}"
                class="mt-4 inline-flex items-center bg-[#9C1C2A] text-white px-4 py-2 rounded-lg shadow hover:bg-[#7C1A24] transition">
                <i class="fas fa-folder-open mr-2"></i> Ver
            </a>
            @else
            <p class="text-gray-500 italic">No se encontró historia clínica.</p>
            @endif
        </div>


        {{-- Historia Ocupacional --}}
        <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-100">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-briefcase text-amber-600"></i>
                Historia Ocupacional
            </h3>

            @if($ficha->historiaOcupacional)
            <div class="space-y-2 text-gray-700">
                <p><strong>Puesto:</strong> {{ $ficha->historiaOcupacional->puesto }}</p>
                <p><strong>Tiempo:</strong> {{ $ficha->historiaOcupacional->tiempo }}</p>
            </div>

            <a href="{{ route('historia.index', [
                        'paciente_id' => $ficha->paciente->id,
                        'from' => 'fichas.detalle',
                        'ficha' => $ficha->id
                    ]) }}"
                class="mt-4 inline-flex items-center bg-[#9C1C2A] text-white px-4 py-2 rounded-lg shadow hover:bg-[#7C1A24] transition">
                <i class="fas fa-folder-open mr-2"></i> Ver
            </a>
            @else
            <p class="text-gray-500 italic">No se encontró historia ocupacional.</p>
            @endif
        </div>


        {{-- Ruta Médica --}}
        <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-100">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-route text-green-600"></i>
                Ruta Médica
            </h3>

            @if($ficha->rutaMedica)
            <div class="space-y-2 text-gray-700">
                <p><strong>Estado:</strong> {{ $ficha->rutaMedica->estado }}</p>
                <p><strong>Observaciones:</strong> {{ Str::limit($ficha->rutaMedica->observaciones, 70) }}</p>
            </div>

            <a href="{{ route('ruta.ver', [
                        'id' => $ficha->rutaMedica->id,
                        'from' => 'fichas.detalle',
                        'ficha' => $ficha->id
                    ]) }}"
                class="mt-4 inline-flex items-center bg-[#9C1C2A] text-white px-4 py-2 rounded-lg shadow hover:bg-[#7C1A24] transition">
                <i class="fas fa-folder-open mr-2"></i> Ver
            </a>
            @else
            <p class="text-gray-500 italic">No se encontró ruta médica.</p>
            @endif
        </div>


        {{-- Evaluaciones --}}
        <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-100">
            <h2 class="text-xl font-semibold text-[#4C4C4C]">Evaluaciones</h2>

            <nav class="w-full bg-white text-[#9C1C2A] p-3 flex items-center justify-center rounded-xl shadow-md mt-4">
                <ul class="flex w-full">
                    @foreach ($areas as $area)
                    @php
                    $palabras = explode(' ', $area->nombre);
                    $abreviatura = count($palabras) > 1
                    ? strtoupper(substr($palabras[0], 0, 2) . substr($palabras[1], 0, 1))
                    : strtoupper(substr($palabras[0], 0, 3));
                    @endphp

                    <li class="group relative flex-1 flex justify-center">
                        <button
                            onclick="mostrarArea({{ $area->id }})"
                            id="btn-area-{{ $area->id }}"
                            class="w-14 h-12 flex items-center justify-center rounded-xl font-semibold transition duration-200
                        bg-white hover:bg-[#FCEBEB] text-[#9C1C2A]"
                            title="{{ $area->nombre }}">
                            {{ $abreviatura }}
                        </button>

                        <div
                            class="absolute left-1/2 top-full transform -translate-x-1/2 mt-2 hidden group-hover:flex
                        bg-white text-[#9C1C2A] text-sm font-medium px-3 py-1 rounded shadow-lg whitespace-nowrap z-10">
                            {{ $area->nombre }}
                        </div>
                    </li>
                    @endforeach
                </ul>
            </nav>
            @foreach ($areas as $area)
            <div id="area-{{ $area->id }}" class="hidden mt-6">

                @foreach ($ficha->evaluaciones->where('area_ocupacional_id', $area->id) as $eval)

                {{-- ADMISION --}}
                @if (strtolower($area->nombre) === 'admision llenado de datos')
                <div class="bg-gray-50 p-3 rounded-lg border mb-4">
                    <p><strong>Hora de Inicio:</strong> {{ $eval->hora_ingreso ?? '—' }}</p>
                    <p><strong>Hora de Fin:</strong> {{ $eval->hora_salida ?? '—' }}</p>
                </div>
                @include('ocupacional.evaluaciones.admision', ['evaluacion' => $eval])
                @endif

                {{-- TRIAJE --}}
                @if (strtolower($area->nombre) === 'triaje')
                <div class="bg-gray-50 p-3 rounded-lg border mb-4">
                    <p><strong>Hora de Inicio:</strong> {{ $eval->hora_ingreso ?? '—' }}</p>
                    <p><strong>Hora de Fin:</strong> {{ $eval->hora_salida ?? '—' }}</p>
                </div>
                @include('ocupacional.evaluaciones.triaje', [
                'evaluacion' => $eval,
                'triaje' => $eval->triaje ?? null
                ])
                @endif

                {{-- OFTALMOLOGIA --}}
                @if (strtolower($area->nombre) === 'oftalmologia')
                <div class="bg-gray-50 p-3 rounded-lg border mb-4">
                    <p><strong>Hora de Inicio:</strong> {{ $eval->hora_ingreso ?? '—' }}</p>
                    <p><strong>Hora de Fin:</strong> {{ $eval->hora_salida ?? '—' }}</p>
                </div>
                @include('ocupacional.evaluaciones.oftalmologia', [
                'evaluacion' => $eval,
                'oftalmologia' => $eval->oftalmologia ?? null
                ])
                @endif

                {{-- AUDIOMETRIA --}}
                @if (strtolower($area->nombre) === 'audiometria')
                <div class="bg-gray-50 p-3 rounded-lg border mb-4">
                    <p><strong>Hora de Inicio:</strong> {{ $eval->hora_ingreso ?? '—' }}</p>
                    <p><strong>Hora de Fin:</strong> {{ $eval->hora_salida ?? '—' }}</p>
                </div>
                @include('ocupacional.evaluaciones.audiometria', [
                'evaluacion' => $eval,
                'audiometria' => $eval->audiometria ?? null
                ])
                @endif

                {{-- ESPIROMETRIA --}}
                @if (strtolower($area->nombre) === 'espirometria')
                <div class="bg-gray-50 p-3 rounded-lg border mb-4">
                    <p><strong>Hora de Inicio:</strong> {{ $eval->hora_ingreso ?? '—' }}</p>
                    <p><strong>Hora de Fin:</strong> {{ $eval->hora_salida ?? '—' }}</p>
                </div>
                @include('ocupacional.evaluaciones.espirometria', [
                'evaluacion' => $eval,
                'espirometria' => $eval->espirometria ?? null
                ])
                @endif

                {{-- PSICOLOGIA --}}
                @if (strtolower($area->nombre) === 'psicologia')
                <div class="bg-gray-50 p-3 rounded-lg border mb-4">
                    <p><strong>Hora de Inicio:</strong> {{ $eval->hora_ingreso ?? '—' }}</p>
                    <p><strong>Hora de Fin:</strong> {{ $eval->hora_salida ?? '—' }}</p>
                </div>
                @include('ocupacional.evaluaciones.psicologia', [
                'evaluacion' => $eval,
                'psicologia' => $eval->psicologia ?? null
                ])
                @endif

                {{-- RADIOGRAFIA --}}
                @if (strtolower($area->nombre) === 'radiografia')
                <div class="bg-gray-50 p-3 rounded-lg border mb-4">
                    <p><strong>Hora de Inicio:</strong> {{ $eval->hora_ingreso ?? '—' }}</p>
                    <p><strong>Hora de Fin:</strong> {{ $eval->hora_salida ?? '—' }}</p>
                </div>
                @include('ocupacional.evaluaciones.radiografia', [
                'evaluacion' => $eval,
                'radiografia' => $eval->radiografia ?? null
                ])
                @endif

                @endforeach

            </div>
            @endforeach

        </div>


    </div>
    <script>
        function mostrarArea(id) {
            localStorage.setItem("areaSeleccionada", id);

            document.querySelectorAll('[id^="area-"]').forEach(div =>
                div.classList.add('hidden')
            );
            document.getElementById(`area-${id}`).classList.remove('hidden');

            document.querySelectorAll('[id^="btn-area-"]').forEach(btn => {
                btn.classList.remove("bg-[#FCEBEB]", "text-[#9C1C2A]");
                btn.classList.add("bg-white", "text-[#9C1C2A]");
            });

            const btnActivo = document.getElementById(`btn-area-${id}`);
            btnActivo.classList.remove("bg-white");
            btnActivo.classList.add("bg-[#FCEBEB]", "text-[#9C1C2A]");
        }

        // Al cargar, mostrar el área seleccionada anteriormente
        document.addEventListener("DOMContentLoaded", () => {
            const areaGuardada = localStorage.getItem("areaSeleccionada");
            if (areaGuardada && document.getElementById(`area-${areaGuardada}`)) {
                mostrarArea(areaGuardada);
            }
        });
    </script>

</x-clinico-layout>
<x-clinico-layout>
    <x-encabezado-clinico />
    <div class="bg-white shadow-md rounded-lg px-6 mt-8 py-6">

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-[#4C4C4C]">Recepción de Pacientes para Salud Ocupacional</h2>
            <a href="{{ route('ruta.crear') }}" class="bg-[#9C1C2A] text-white px-4 py-2 rounded hover:bg-[#b91c1c] transition">
                Nuevo
            </a>
        </div>

        {{-- 🔹 Filtro con checkbox --}}
        <form method="GET" action="{{ route('inicio') }}" class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="mostrar_todos" value="1"
                    onchange="this.form.submit()"
                    {{ request('mostrar_todos') ? 'checked' : '' }}>
                <span class="ml-2 text-[#4C4C4C]">Mostrar todos los pacientes</span>
            </label>
        </form>

        <table class="w-full table-auto border-collapse">
            <thead class="bg-[#9C1C2A] text-white">
                <tr>
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">DNI</th>
                    <th class="px-4 py-2 text-left">Apellidos y Nombres</th>
                    <th class="px-4 py-2 text-left">Cargo</th>
                    <th class="px-4 py-2 text-left">Empresa</th>
                    <th class="px-4 py-2 text-left">Hoja de Ruta</th>
                    <th class="px-4 py-2 text-left">Ficha Ocupacional</th>
                    <th class="px-4 py-2 text-left">Progreso</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rutas as $index => $ruta)
                @php
                // Asegura tener la relación cargada (ideal: with('evaluaciones') en el controlador)
                $evaluaciones = $ruta->evaluaciones ?? collect();

                // Solo cuentan las que sí aplican (excluye no_aplica)
                $evaluacionesValidas = $evaluaciones->where('estado', '!=', 'no_aplica');

                $total = $evaluacionesValidas->count();
                $completadas = $evaluacionesValidas->where('estado', 'completada')->count();

                $progreso = $total > 0 ? round(($completadas / $total) * 100) : 0;
                @endphp

                <tr class="text-[#4C4C4C] border-b">
                    <!-- columnas anteriores... -->
                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                    <td class="px-4 py-2">{{ $ruta->documento }}</td>
                    <td class="px-4 py-2">{{ $ruta->apellidos }}, {{ $ruta->nombres }}</td>
                    <td class="px-4 py-2">{{ $ruta->cargo }}</td>
                    <td class="px-4 py-2">{{ $ruta->empresa }}</td>
                    <td class="px-4 py-2 text-center">
                        <a href="{{ route('ruta.ver', $ruta->id) }}" class="text-[#9C1C2A] hover:underline">Ver Ruta</a>
                    </td>
                    <td class="px-4 py-2 text-center">
                        @if ($ruta->fichaOcupacional)
                        <a href="{{ route('ocupacional.fichas.editar', $ruta->fichaOcupacional->id) }}" class="text-[#9C1C2A] hover:underline hover:text-[#b91c1c]">Editar Ficha</a>
                        @else
                        <a href="{{ route('ocupacional.fichas.crear', ['id' => $ruta->id]) }}" class="text-[#4C4C4C] hover:underline hover:text-[#b91c1c]">Crear Ficha</a>
                        @endif
                    </td>
                    <td id="progreso-{{ $ruta->id }}">
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div id="barra-progreso-{{ $ruta->id }}"
                                class="bg-[#9C1C2A] h-4 rounded-full text-xs text-white text-center"
                                style="width: {{ $progreso }}%;">
                                {{ $progreso }}%
                            </div>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>


        </table>
    </div>

    {{-- Script AJAX para actualizar progreso --}}
    <script>
        function iniciarEvaluacion(evaluacionId, rutaId) {
            fetch(`/evaluaciones/${evaluacionId}/iniciar`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    document.getElementById(`btn-iniciar-${evaluacionId}`).textContent = 'Iniciada';
                    document.getElementById(`btn-iniciar-${evaluacionId}`).disabled = true;
                    document.getElementById(`btn-finalizar-${evaluacionId}`).disabled = false;

                    actualizarProgresoRuta(rutaId);
                });
        }

        function finalizarEvaluacion(evaluacionId, rutaId) {
            fetch(`/evaluaciones/${evaluacionId}/finalizar`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    document.getElementById(`btn-finalizar-${evaluacionId}`).textContent = 'Finalizada';
                    document.getElementById(`btn-finalizar-${evaluacionId}`).disabled = true;

                    actualizarProgresoRuta(rutaId);
                });
        }

        function actualizarProgresoRuta(rutaId) {
            fetch(`/ruta/${rutaId}/progreso`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    console.log("Respuesta completa:", data);

                    const barra = document.getElementById(`barra-progreso-${rutaId}`);
                    if (barra) {
                        barra.style.width = data.progreso + '%';
                        barra.textContent = data.progreso + '%';
                    }

                    const celdaEstado = document.getElementById(`estado-ruta-${rutaId}`);
                    if (celdaEstado) {
                        celdaEstado.textContent = data.estado;
                    }

                    const celdaFecha = document.getElementById(`fecha-salida-${rutaId}`);
                    if (celdaFecha && data.fecha_salida) {
                        celdaFecha.textContent = data.fecha_salida;
                    }
                });
        }
    </script>

</x-clinico-layout>
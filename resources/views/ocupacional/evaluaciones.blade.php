<x-clinico-layout>
    <x-encabezado-clinico />

    <div class="bg-white shadow-md rounded-lg px-6 mt-8 py-6">
        <h2 class="text-xl font-semibold text-[#4C4C4C]">Evaluaciones</h2>

        {{-- Sidebar con áreas ocupacionales --}}
        <nav class="w-full bg-white text-[#9C1C2A] p-3 flex items-center justify-center rounded-xl shadow-md mt-4">
            <ul class="flex w-full">
                @foreach ($areas as $area)
                @php
                $palabras = explode(' ', $area->nombre);
                $abreviatura = count($palabras) > 1
                ? strtoupper(substr($palabras[0], 0, 2) . substr($palabras[1], 0, 1))
                : strtoupper(substr($palabras[0], 0, 3));
                $isActive = isset($areaSeleccionada) && $areaSeleccionada == $area->id;
                @endphp

                <li class="group relative flex-1 flex justify-center">
                    <button
                        onclick="mostrarArea({{ $area->id }})"
                        id="btn-area-{{ $area->id }}"
                        class="w-14 h-12 flex items-center justify-center rounded-xl font-semibold transition duration-200
                            {{ $isActive ? 'bg-[#FCEBEB] text-[#9C1C2A]' : 'bg-white hover:bg-[#FCEBEB] text-[#9C1C2A]' }}"
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

        <div class="p-6">
            @foreach ($areas as $area)
            <div id="area-{{ $area->id }}" class="{{ $areaSeleccionada == $area->id ? '' : 'hidden' }}">

                @if ($area->evaluaciones->isEmpty())
                <p class="text-gray-500">No hay pacientes pendientes en esta área.</p>
                @else

                <table class="w-full border-collapse bg-white shadow rounded-lg">
                    <thead class="bg-[#9C1C2A] text-white">
                        <tr>
                            <th class="px-4 py-2">Paciente</th>
                            <th class="px-4 py-2">Documento</th>
                            <th class="px-4 py-2">Tipo Evaluación</th>
                            <th class="px-4 py-2">Empresa</th>
                            <th class="px-4 py-2">N° Ficha</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($area->evaluaciones->take(3) as $eval)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $eval->rutaMedica->nombres }} {{ $eval->rutaMedica->apellidos }}</td>
                            <td class="px-4 py-2">{{ $eval->rutaMedica->documento }}</td>
                            <td class="px-4 py-2">{{ $eval->rutaMedica->tipo_evaluacion }}</td>
                            <td class="px-4 py-2">{{ $eval->rutaMedica->empresa ?? 'Sin empresa' }}</td>
                            <td class="px-4 py-2">{{ $eval->rutaMedica->fichaOcupacional->numero_ficha ?? '—' }}</td>

                            <td class="px-4 py-2 flex items-center space-x-2">

                                <button
                                    onclick="iniciarEvaluacion({{ $eval->id }})"
                                    id="btn-iniciar-{{ $eval->id }}"
                                    class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 text-sm"
                                    {{ $eval->hora_ingreso ? 'disabled' : '' }}>
                                    {{ $eval->hora_ingreso ? 'Iniciada' : 'Iniciar' }}
                                </button>

                                <button
                                    onclick="finalizarEvaluacion({{ $eval->id }}, {{ $area->id }})"
                                    id="btn-finalizar-{{ $eval->id }}"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm"
                                    {{ !$eval->hora_ingreso || $eval->hora_salida ? 'disabled' : '' }}>
                                    {{ $eval->hora_salida ? 'Finalizada' : 'Finalizar' }}
                                </button>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                    {{-- Resto oculto --}}
                    @if ($area->evaluaciones->count() > 3)
                    <tbody id="extra-{{ $area->id }}" class="hidden">
                        @foreach ($area->evaluaciones->skip(3) as $eval)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $eval->rutaMedica->nombres }} {{ $eval->rutaMedica->apellidos }}</td>
                            <td class="px-4 py-2">{{ $eval->rutaMedica->documento }}</td>
                            <td class="px-4 py-2">{{ $eval->rutaMedica->tipo_evaluacion }}</td>
                            <td class="px-4 py-2">{{ $eval->rutaMedica->empresa }}</td>
                            <td class="px-4 py-2">{{ $eval->rutaMedica->fichaOcupacional->numero_ficha ?? '—' }}</td>

                            <td class="px-4 py-2 flex items-center space-x-2">
                                <button
                                    onclick="iniciarEvaluacion({{ $eval->id }})"
                                    id="btn-iniciar-{{ $eval->id }}"
                                    class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 text-sm"
                                    {{ $eval->hora_ingreso ? 'disabled' : '' }}>
                                    {{ $eval->hora_ingreso ? 'Iniciada' : 'Iniciar' }}
                                </button>

                                <button
                                    onclick="finalizarEvaluacion({{ $eval->id }}, {{ $area->id }})"
                                    id="btn-finalizar-{{ $eval->id }}"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm"
                                    {{ !$eval->hora_ingreso || $eval->hora_salida ? 'disabled' : '' }}>
                                    {{ $eval->hora_salida ? 'Finalizada' : 'Finalizar' }}
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>

                <div class="mt-2 text-start">
                    <span class="text-lg font-semibold text-[#4C4C4C]">{{ $area->nombre }}</span>

                    <div class="text-end">
                        @if ($area->evaluaciones->count() > 3)
                        <button
                            onclick="togglePacientes({{ $area->id }})"
                            id="btn-toggle-{{ $area->id }}"
                            class="bg-[#9C1C2A] text-white px-4 py-2 rounded shadow text-sm">
                            Mostrar todos
                        </button>
                        @endif
                    </div>

                </div>

                @endif
            </div>
            @endforeach
        </div>
    </div>

    {{-- ==== SCRIPTS ==== --}}

    <script>
        function mostrarArea(id) {
            // Guardar el área seleccionada en LocalStorage
            localStorage.setItem("areaSeleccionada", id);

            // Ocultar todas las áreas
            document.querySelectorAll('[id^="area-"]').forEach(div =>
                div.classList.add('hidden')
            );
            document.getElementById(`area-${id}`).classList.remove('hidden');

            // Quitar selección de todos los botones
            document.querySelectorAll('[id^="btn-area-"]').forEach(btn => {
                btn.classList.remove("bg-[#FCEBEB]", "text-[#9C1C2A]");
                btn.classList.add("bg-white", "text-[#9C1C2A]");
            });

            // Activar el botón seleccionado
            const btnActivo = document.getElementById(`btn-area-${id}`);
            btnActivo.classList.remove("bg-white");
            btnActivo.classList.add("bg-[#FCEBEB]", "text-[#9C1C2A]");
        }
    </script>


    <script>
        function iniciarEvaluacion(id) {
            fetch(`/evaluaciones/${id}/iniciar`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const btnIniciar = document.getElementById(`btn-iniciar-${id}`);
                        btnIniciar.textContent = `Iniciada (${data.hora_ingreso})`;
                        btnIniciar.disabled = true;

                        const btnFinalizar = document.getElementById(`btn-finalizar-${id}`);
                        btnFinalizar.disabled = false;
                    }
                })
                .catch(err => console.error(err));
        }
    </script>

    <script>
        function finalizarEvaluacion(id, areaId) {
            fetch(`/evaluaciones/${id}/finalizar`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {

                        const btnFinalizar = document.getElementById(`btn-finalizar-${id}`);
                        btnFinalizar.textContent = `Finalizada (${data.hora_salida})`;
                        btnFinalizar.disabled = true;

                        const fila = btnFinalizar.closest("tr");
                        fila.classList.add("opacity-50");

                        setTimeout(() => {
                            fila.remove();
                            moverSiguientePaciente(areaId);
                        }, 300);
                    }
                })
                .catch(err => console.error(err));
        }
    </script>

    <script>
        function togglePacientes(areaId) {
            const extra = document.getElementById(`extra-${areaId}`);
            const btn = document.getElementById(`btn-toggle-${areaId}`);

            if (extra.classList.contains("hidden")) {
                extra.classList.remove("hidden");
                btn.textContent = "Mostrar menos";
            } else {
                extra.classList.add("hidden");
                btn.textContent = "Mostrar todos";
            }
        }
    </script>

    <script>
        function moverSiguientePaciente(areaId) {
            const areaDiv = document.getElementById(`area-${areaId}`);

            const extra = document.getElementById(`extra-${areaId}`);
            const btnToggle = document.getElementById(`btn-toggle-${areaId}`);

            // Capturar tbody principal (el primero de la tabla)
            const tbodyPrincipal = areaDiv.querySelector("table tbody");

            if (extra) {
                const filasExtra = extra.querySelectorAll("tr");

                if (filasExtra.length > 0) {
                    const siguiente = filasExtra[0];
                    tbodyPrincipal.appendChild(siguiente);
                }

                // Si ya no quedan filas en extra → ocultarlo
                if (extra.querySelectorAll("tr").length === 0) {
                    extra.classList.add("hidden");
                }
            }

            // Contar pacientes totales después de mover
            const filasTotales = areaDiv.querySelectorAll("table tbody tr");

            // Si hay 3 o menos pacientes → ocultar botón “Mostrar todos”
            if (btnToggle) {
                if (filasTotales.length <= 3) {
                    btnToggle.classList.add("hidden");
                } else {
                    btnToggle.classList.remove("hidden");
                }
            }

            // Si ya no hay pacientes → mensaje vacío
            if (filasTotales.length === 0) {
                areaDiv.innerHTML = `<p class="text-gray-500">No hay pacientes pendientes en esta área.</p>`;
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let ultimaArea = localStorage.getItem("areaSeleccionada");

            if (ultimaArea) {
                // Si existe en LocalStorage → abrirla
                mostrarArea(ultimaArea);
            } else {
                // Si no existe → abrir la primera área por defecto
                const primerBoton = document.querySelector('[id^="btn-area-"]');
                if (primerBoton) {
                    const id = primerBoton.id.replace("btn-area-", "");
                    mostrarArea(id);
                }
            }
        });
    </script>


</x-clinico-layout>
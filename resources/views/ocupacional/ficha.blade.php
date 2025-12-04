<x-clinico-layout>
    <x-encabezado-clinico />

    <div class="bg-white shadow-md rounded-lg px-6 mt-8 py-6">
        <h2 class="text-xl font-semibold text-[#4C4C4C]">
            Fichas Ocupacionales
        </h2>

        {{-- Filtros y búsqueda --}}
        <form method="GET" action="{{ route('ficha_ocupacional') }}" class=" pt-4 mb-6 space-y-2">

            {{-- Grupo 1: Búsqueda por paciente/historia --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <x-input-clinico label="Apellidos" name="apellidos" type="text"
                    :value="request('apellidos')" placeholder="Apellido del paciente" />

                <x-input-clinico label="DNI" name="dni" type="text"
                    :value="request('dni')" placeholder="Número de documento" />

                <x-input-clinico label="N° Historia" name="historia" type="text"
                    :value="request('historia')" placeholder="Número de historia clínica" />
            </div>

            {{-- Grupo 2: Otros filtros --}}
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div class="flex gap-2 items-end">
                    <x-input-clinico
                        label="Empresa"
                        name="empresa"
                        id="empresaFiltro"
                        type="text"
                        :value="request('empresa')"
                        placeholder="Empresa" />

                    <button type="button"
                        onclick="abrirModalEmpresa('empresaFiltro')"
                        class="px-3 h-[42px] bg-gray-300 text-[#4C4C4C] rounded hover:bg-gray-400 transition shadow mb-4">
                        Buscar
                    </button>
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700">Tipo de Evaluación</label>
                    <select name="tipo_evaluacion"
                        class="border rounded-md px-3 py-2 w-full focus:outline-noneborder-gray-300 focus:border-[#9C1C2A] focus:ring-[#9C1C2A] mt-1">
                        <option value="">Todos</option>
                        <option value="inicio" {{ request('tipo_evaluacion') == 'inicio' ? 'selected' : '' }}>Inicio</option>
                        <option value="periodico" {{ request('tipo_evaluacion') == 'periodico' ? 'selected' : '' }}>Periódico</option>
                        <option value="retiro" {{ request('tipo_evaluacion') == 'retiro' ? 'selected' : '' }}>Retiro</option>
                        <option value="reubicacion" {{ request('tipo_evaluacion') == 'reubicacion' ? 'selected' : '' }}>Reubicación</option>
                        <option value="P.Serologica" {{ request('tipo_evaluacion') == 'P.Serologica' ? 'selected' : '' }}>P.Serológica</option>
                        <option value="P.Molecular" {{ request('tipo_evaluacion') == 'P.Molecular' ? 'selected' : '' }}>P.Molecular</option>
                        <option value="P.Antigenica" {{ request('tipo_evaluacion') == 'P.Antigenica' ? 'selected' : '' }}>P.Antigénica</option>
                        <option value="P.Cuantitativa" {{ request('tipo_evaluacion') == 'P.Cuantitativa' ? 'selected' : '' }}>P.Cuantitativa</option>
                    </select>
                </div>

                <x-input-clinico label="Desde" name="desde" type="date"
                    :value="$mostrarHoy ? $hoy : request('desde')" />

                <x-input-clinico label="Hasta" name="hasta" type="date"
                    :value="$mostrarHoy ? $hoy : request('hasta')" />

                <div>
                    <label class="block text-sm font-medium text-gray-700">Estado Ruta</label>
                    <select name="estado_ruta"
                        class="border rounded-md px-3 py-2 w-full focus:outline-none border-gray-300 focus:border-[#9C1C2A] focus:ring-[#9C1C2A] mt-1">
                        <option value="">Todos</option>
                        <option value="pendiente" {{ request('estado_ruta') == 'pendiente' ? 'selected' : '' }}>
                            Pendiente
                        </option>
                        <option value="finalizado" {{ request('estado_ruta') == 'finalizado' ? 'selected' : '' }}>
                            Finalizado
                        </option>
                    </select>
                </div>

            </div>




            {{-- Botones --}}
            <div class="flex items-end gap-2 space-y-2">
                <div class="flex items-start gap-3">
                    <button type="submit"
                        class="bg-[#9C1C2A] text-white px-4 py-2 rounded hover:bg-[#b91c1c] transition">
                        Filtrar
                    </button>
                    <a href="{{ route('ficha_ocupacional') }}"
                        class="px-4 py-2 bg-gray-300 text-[#4C4C4C] rounded hover:bg-gray-400 transition">Limpiar</a>

                    <div class="flex items-center gap-2 ml-2 mt-2">
                        <input type="checkbox" id="hoy" name="hoy" value="1"
                            {{ $mostrarHoy ? 'checked' : '' }}
                            class="accent-[#9C1C2A]">

                        <label for="hoy" class="text-[#4C4C4C]">Hoy</label>

                    </div>

                </div>
                <div class="flex-1 text-right">
                    <span class="text-gray-500 text-sm">
                        Total: {{ $fichas->count() }}
                    </span>
                </div>
            </div>
        </form>



        {{-- Tabla general --}}
        <div class="bg-white shadow-md  overflow-hidden ">

            @if($fichas->isEmpty())
            <p class="p-4 text-gray-500 text-center">No se encontraron fichas ocupacionales.</p>
            @else
            <table class="w-full table-auto border-collapse">
                <thead class="bg-[#9C1C2A] text-white">
                    <tr>
                        <th class="px-1 py-2 text-left">Apellidos y Nombres</th>
                        <th class="px-1 py-2 text-left">N° Documento</th>
                        <th class="px-1 py-2 text-left">N° Historia</th>
                        <th class="px-1 py-2 text-left">N° Ficha</th>
                        <th class="px-1 py-2 text-left">Empresa</th>
                        <th class="px-1 py-2 text-left">Tipo Evaluación</th>
                        <th class="px-1 py-2 text-left">Fecha</th>
                        <th class="px-1 py-2 text-left">Estado Ruta</th>
                        <th class="px-1 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fichas as $ficha)
                    <tr class="border-t">
                        <td class="px-1 py-2">
                            {{ $ficha->paciente->apellidos }}, {{ $ficha->paciente->nombres }}
                        </td>
                        <td class="px-1 py-2">{{ $ficha->paciente->documento }}</td>
                        <td class="px-1 py-2">{{ $ficha->historiaClinica->numero_historia ?? '-' }}</td>
                        <td class="px-1 py-2">{{ $ficha->numero_ficha ?? '-' }}</td> {{-- Nueva celda --}}
                        <td class="px-1 py-2">{{ $ficha->empresa }}</td>
                        <td class="px-1 py-2 capitalize">{{ $ficha->tipo_evaluacion }}</td>
                        <td class="px-1 py-2">{{ $ficha->created_at->format('d/m/Y') }}</td>
                        <td class="px-1 py-2">
                            @if($ficha->rutaMedica)
                            @if($ficha->rutaMedica->estado === 'finalizado')
                            <span class="text-green-600 font-semibold">Finalizado</span>

                            @else
                            {{-- 🔹 "Pendiente" ahora es un enlace clickeable --}}
                            <a href="{{ route('evaluaciones.continuar', $ficha->rutaMedica->id) }}"
                                title="Continuar evaluación"
                                class="text-yellow-600 font-semibold hover:text-yellow-700 hover:underline">
                                Pendiente
                            </a>
                            @endif

                            @else
                            <span class="text-gray-500 italic">Sin Ruta</span>
                            @endif
                        </td>



                        <td class="px-1 py-2 text-center">
                            <a href="{{ route('ocupacional.fichas.editar', $ficha->id) }}" class="text-[#9C1C2A] hover:text-[#b91c1c]">
                                Editar
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>


        <div class="mt-4">
            {{ $fichas->links() }}
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hoyCheckbox = document.getElementById('hoy');
            const inputs = document.querySelectorAll('input[type="text"], input[type="date"], select');

            // Si modificas cualquier filtro, se desactiva el checkbox "Hoy"
            inputs.forEach(input => {
                input.addEventListener('input', () => {
                    hoyCheckbox.checked = false;
                });
            });

            // Si el checkbox se desactiva manualmente, limpia las fechas
            hoyCheckbox.addEventListener('change', () => {
                const desdeInput = document.querySelector('input[name="desde"]');
                const hastaInput = document.querySelector('input[name="hasta"]');

                if (!hoyCheckbox.checked) {
                    desdeInput.value = '';
                    hastaInput.value = '';
                } else {
                    // Fecha LOCAL (sin saltar al día siguiente)
                    const hoy = new Date().toLocaleDateString('en-CA');
                    desdeInput.value = hoy;
                    hastaInput.value = hoy;
                }
            });
        });
    </script>

</x-clinico-layout>
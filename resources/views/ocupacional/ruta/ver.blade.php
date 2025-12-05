<x-clinico-layout>
    <x-encabezado-clinico />
    <div class="mt-8 px-6">
        <h2 class="text-2xl font-bold text-[#4C4C4C] mb-4">Hoja de Ruta Médica</h2>

        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <p><strong>DNI:</strong> {{ $ruta->documento }}</p>
            <p><strong>Nombre:</strong> {{ $ruta->nombres }} {{ $ruta->apellidos }}</p>
            <p><strong>Empresa:</strong> {{ $ruta->empresa }}</p>
            <p><strong>Cargo:</strong> {{ $ruta->cargo }}</p>
            <p><strong>Tipo de Evaluación:</strong> {{ $ruta->tipo_evaluacion }}</p>
            <p><strong>Registrado por:</strong> {{ $ruta->registrado_por }}</p>
            <p><strong>Fecha de Registro:</strong> {{ $ruta->registrado_en->format('d/m/Y H:i') }}</p>
        </div>

        <form action="{{ route('ruta.guardarEvaluaciones', $ruta->id) }}" method="POST">
            @csrf
            <div class="mt-8 bg-white rounded-lg shadow p-6">
                <table class="w-full table-auto border-collapse">
                    <thead class="bg-[#9C1C2A] text-white">
                        <tr>
                            <th class="px-4 py-2 text-center">No Aplica</th>
                            <th class="px-4 py-2 text-left">Área</th>
                            <th class="px-4 py-2 text-left">Ubicación</th>
                            <th class="px-4 py-2 text-center">Hora Ingreso</th>
                            <th class="px-4 py-2 text-center">Hora Salida</th>
                            <th class="px-4 py-2 text-left">Encargado</th>
                            <th class="px-4 py-2 text-left">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluaciones as $eval)
                        @php
                        $area = $eval->areaOcupacional;
                        @endphp
                        <tr class="text-[#4C4C4C] border-t transition-colors duration-200 {{ $eval->no_aplica ? 'bg-[#DADADA]' : '' }}" id="fila-area-{{ $area->id }}">
                            <td class="px-4 py-2 text-center">
                                <label class="cursor-pointer select-none">
                                    <input
                                        type="checkbox"
                                        name="no_aplica[{{ $area->id }}]"
                                        class="hidden peer"
                                        id="no-aplica-{{ $area->id }}"
                                        {{ $eval->no_aplica ? 'checked' : '' }}
                                        onchange="
                document.getElementById('fila-area-{{ $area->id }}').classList.toggle('bg-[#DADADA]', this.checked);
                document.getElementById('ingreso-{{ $area->id }}').disabled = this.checked;
                document.getElementById('salida-{{ $area->id }}').disabled = this.checked;
                document.getElementById('encargado-{{ $area->id }}').disabled = this.checked;
                document.getElementById('observaciones-{{ $area->id }}').disabled = this.checked;
            ">
                                    <span class="w-6 h-6 border-2 border-[#9C1C2A] inline-flex items-center justify-center text-[#9C1C2A] peer-checked:bg-[#9C1C2A] peer-checked:text-white">
                                        ✕
                                    </span>
                                </label>

                                {{-- Script para aplicar el estado inicial al cargar --}}
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const checkbox = document.getElementById('no-aplica-{{ $area->id }}');
                                        const fila = document.getElementById('fila-area-{{ $area->id }}');
                                        const ingreso = document.getElementById('ingreso-{{ $area->id }}');
                                        const salida = document.getElementById('salida-{{ $area->id }}');
                                        const encargado = document.getElementById('encargado-{{ $area->id }}');
                                        const observaciones = document.getElementById('observaciones-{{ $area->id }}');

                                        if (checkbox.checked) {
                                            fila.classList.add('bg-[#DADADA]');
                                            ingreso.disabled = true;
                                            salida.disabled = true;
                                            encargado.disabled = true;
                                            observaciones.disabled = true;
                                        }
                                    });
                                </script>
                            </td>

                            <td class="px-4 py-2">{{ $area->nombre }}</td>
                            <td class="px-4 py-2">{{ $area->ubicacion }}</td>
                            <td class="px-4 py-2 text-center">
                                <input type="time" name="hora_ingreso[{{ $area->id }}]" id="ingreso-{{ $area->id }}"
                                    value="{{ $eval->hora_ingreso ? \Carbon\Carbon::parse($eval->hora_ingreso)->format('H:i') : '' }}"
                                    class="border rounded px-2 py-1 w-full focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                                    {{ $eval->no_aplica ? 'disabled' : '' }}>

                            </td>
                            <td class="px-4 py-2 text-center">
                                <input type="time" name="hora_salida[{{ $area->id }}]" id="salida-{{ $area->id }}"
                                    value="{{ $eval->hora_salida ? \Carbon\Carbon::parse($eval->hora_salida)->format('H:i') : '' }}"
                                    class="border rounded px-2 py-1 w-full focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                                    {{ $eval->no_aplica ? 'disabled' : '' }}>

                            </td>
                            <td class="px-4 py-2">
                                <input type="text" name="encargado[{{ $area->id }}]" id="encargado-{{ $area->id }}"
                                    value="{{ $eval->usuario?->name }}"
                                    class="border rounded px-2 py-1 w-full focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                                    {{ $eval->no_aplica ? 'disabled' : '' }}>
                            </td>
                            <td class="px-4 py-2">
                                <textarea name="observaciones[{{ $area->id }}]" id="observaciones-{{ $area->id }}" rows="1"
                                    class="h-[38px] resize-none border rounded px-2 py-1 w-full focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                                    {{ $eval->no_aplica ? 'disabled' : '' }}>{{ $eval->observaciones }}</textarea>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @php
            $from = request('from');
            @endphp

            <div class="flex justify-end space-x-4 mt-6">

                <a href="{{ $from === 'inicio' ? route('inicio') : route('fichas.detalle', request()->query('ficha')) }}"
                    class="bg-gray-300 text-[#4C4C4C] px-6 py-2 rounded shadow hover:bg-gray-500">
                    Salir
                </a>

                <button type="submit" class="px-4 py-2 bg-[#9C1C2A] text-white rounded hover:bg-[#b91c1c] transition">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</x-clinico-layout>
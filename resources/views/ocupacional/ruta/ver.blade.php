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
                    @foreach ($areasOcupacionales as $area)
                    <tr class="text-[#4C4C4C] border-t transition-colors duration-200" id="fila-area-{{ $area->id }}">
                        <td class="px-4 py-2 text-center">
                            <input
                                type="checkbox"
                                name="no_aplica[{{ $area->id }}]"
                                class="w-5 h-5 appearance-none border-2 border-[#9C1C2A] rounded-sm cursor-pointer transition-all duration-150 checked:bg-[#9C1C2A] checked:border-[#9C1C2A] focus:outline-none focus:ring-0 focus:ring-offset-0 active:bg-[#9C1C2A] active:ring-0 active:outline-none"
                                onchange="
                                    document.getElementById('fila-area-{{ $area->id }}').classList.toggle('bg-[#DADADA]', this.checked);
                                    document.getElementById('ingreso-{{ $area->id }}').disabled = this.checked;
                                    document.getElementById('salida-{{ $area->id }}').disabled = this.checked;
                                    document.getElementById('encargado-{{ $area->id }}').disabled = this.checked;
                                    document.getElementById('observaciones-{{ $area->id }}').disabled = this.checked;">
                        </td>
                        <td class="px-4 py-2">{{ $area->nombre }}</td>
                        <td class="px-4 py-2">{{ $area->ubicacion }}</td>
                        <td class="px-4 py-2 text-center">
                            <input type="time" name="hora_ingreso[{{ $area->id }}]" id="ingreso-{{ $area->id }}" class="border rounded px-2 py-1 w-full  focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                        </td>
                        <td class="px-4 py-2 text-center">
                            <input type="time" name="hora_salida[{{ $area->id }}]" id="salida-{{ $area->id }}" class="border rounded px-2 py-1 w-full  focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                        </td>
                        <td class="px-4 py-2">
                            <input type="text" name="encargado[{{ $area->id }}]" id="encargado-{{ $area->id }}" class="border rounded px-2 py-1 w-full  focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                        </td>
                        <td class="px-4 py-2">
                            <textarea name="observaciones[{{ $area->id }}]" id="observaciones-{{ $area->id }}" rows="1" class="h-[38px] resize-none border rounded px-2 py-1 w-full  focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"></textarea>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

        
</x-clinico-layout>
<x-clinico-layout>
    <x-encabezado-clinico />

    <div class="bg-white shadow-md rounded-lg px-6 mt-8 py-6">

        {{-- Título --}}
        <h2 class="text-2xl font-semibold text-[#4C4C4C] mb-4">
            Historial Ocupacional del Paciente
        </h2>

        {{-- Nombre del paciente --}}
        <div class="text-lg font-medium text-[#4C4C4C] mb-4">
            {{ $paciente->nombres }} {{ $paciente->apellidos }}
        </div>

        {{-- TABLA DEL HISTORIAL --}}
        <table class="w-full border-collapse bg-white shadow rounded-lg">
            <thead class="bg-[#9C1C2A] text-white">
                <tr>
                    <th class="px-4 py-2">Fecha Inicio</th>
                    <th class="px-4 py-2">Empresa</th>
                    <th class="px-4 py-2">Actividad</th>
                    <th class="px-4 py-2">M.S.N.M</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($historial as $item)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2 text-center">{{ $item->fecha_inicio }}</td>
                    <td class="px-4 py-2 text-center">{{ $item->empresa }}</td>
                    <td class="px-4 py-2 text-center">{{ $item->actividad_realizada }}</td>
                    <td class="px-4 py-2 text-center">{{ $item->altura_snm ?? '—' }}</td>


                    <td class="px-4 py-2 flex justify-center space-x-2">

                        {{-- Botón Editar --}}
                        <a href="{{ route('historia.edit', [
                                'id' => $item->id,
                                'from' => request('from'),
                                'ficha' => request('ficha')
                            ]) }}"
                            class="text-[#9C1C2A] hover:underline">
                            Editar
                        </a>


                        {{-- Botón Eliminar --}}
                        <form action="{{ route('historia.destroy', [
                                    'id' => $item->id,
                                    'from' => request('from'),
                                    'ficha' => request('ficha')
                                ]) }}"
                            method="POST"
                            onsubmit="return confirm('¿Eliminar este registro?')">

                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="from" value="{{ request('from') }}">
                            <input type="hidden" name="ficha" value="{{ request('ficha') }}">

                            <button class="text-[#4C4C4C] hover:underline">
                                Eliminar
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-4">
                        No hay historial ocupacional registrado para este paciente.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- BOTONES ABAJO --}}
        @php
        $from = request('from');
        @endphp

        <div class="flex justify-end space-x-3 mt-5">

            {{-- Botón Salir --}}
            <a href="{{ $from === 'evaluaciones' 
                        ? route('evaluaciones')
                        : route('fichas.detalle', ['ficha' => request('ficha')]) 
                    }}"
                class="px-4 py-2 bg-gray-300 text-[#4C4C4C] rounded hover:bg-gray-400 transition">
                Salir
            </a>


            {{-- Botón Nuevo --}}
            <a href="{{ route('historia.crear', [
                'paciente_id' => $paciente->id,
                'from' => request('from'),
                'ficha' => request('ficha')
            ]) }}"

                class="px-4 py-2 bg-[#9C1C2A] text-white rounded hover:bg-[#b91c1c] transition">
                Nuevo Historial
            </a>


        </div>

    </div>
</x-clinico-layout>
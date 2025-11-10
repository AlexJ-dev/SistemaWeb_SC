<x-clinico-layout>
    <x-encabezado-clinico />
    <div class="mt-8 px-6">
        <p class="text-lg text-[#4C4C4C] mt-2">
            Bienvenido al sistema de Salud Ocupacional
        </p>
        <div class="mt-8 bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-[#4C4C4C]">Recepción de Pacientes para Salud Ocupacional</h2>
                <a href="{{ route('ruta.crear') }}" class="bg-[#9C1C2A] text-white px-4 py-2 rounded hover:bg-[#b91c1c] transition">
                    Nuevo
                </a>
            </div>
            <table class="w-full table-auto border-collapse">
                <thead class="bg-[#9C1C2A] text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">N°</th>
                        <th class="px-4 py-2 text-left">DNI</th>
                        <th class="px-4 py-2 text-left">Apellidos y Nombres</th>
                        <th class="px-4 py-2 text-left">Cargo</th>
                        <th class="px-4 py-2 text-left">Empresa</th>
                        <th class="px-4 py-2 text-left">Historia Clínica</th>
                        <th class="px-4 py-2 text-left">Hoja de Ruta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rutas as $index => $ruta)
                    <tr class="text-[#4C4C4C]">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $ruta->documento }}</td>
                        <td class="px-4 py-2">{{ $ruta->apellidos }}, {{ $ruta->nombres }}</td>
                        <td class="px-4 py-2">{{ $ruta->cargo }}</td>
                        <td class="px-4 py-2">{{ $ruta->empresa }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('historiaClinica.editar', ['dni' => $ruta->documento, 'from' => 'inicio']) }}" class="text-[#9C1C2A] underline">
                                Historia
                            </a>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('ruta.ver', ['dni' => $ruta->documento]) }}" class="text-[#9C1C2A] underline">Ruta</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-clinico-layout>
<x-clinico-layout>
    <x-encabezado-clinico />

    <div class="container mx-auto px-4 mt-6">
        <h1 class="text-2xl font-bold mb-4">Pacientes Registrados</h1>

        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead class="bg-red-800 text-white">
                <tr>
                    <th class="px-4 py-2">Nombres</th>
                    <th class="px-4 py-2">Apellidos</th>
                    <th class="px-4 py-2">Documento</th>
                    <th class="px-4 py-2">Empresa</th>
                    <th class="px-4 py-2">Tipo Evaluación</th>
                    <th class="px-4 py-2">Estado Ruta</th>
                    <th class="px-4 py-2">Progreso</th>
                    <th class="px-4 py-2 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rutas as $ruta)
                    @php
                        $total = $ruta->evaluaciones->count();
                        $completadas = $ruta->evaluaciones->whereIn('estado', ['completada','no_aplica'])->count();
                        $progreso = $total > 0 ? round(($completadas / $total) * 100) : 0;
                    @endphp
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $ruta->nombres }}</td>
                        <td class="px-4 py-2">{{ $ruta->apellidos }}</td>
                        <td class="px-4 py-2">{{ $ruta->documento }}</td>
                        <td class="px-4 py-2">{{ $ruta->empresa }}</td>
                        <td class="px-4 py-2">{{ $ruta->tipo_evaluacion }}</td>
                        <td class="px-4 py-2 capitalize">{{ $ruta->estado }}</td>
                        <td class="px-4 py-2">{{ $progreso }}%</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('ruta.ver', $ruta->id) }}"
                               class="px-3 py-1 bg-red-700 text-white rounded shadow hover:bg-red-600">
                               Ver Flujo
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-clinico-layout>

<x-clinico-layout>
    <x-encabezado-clinico />

    <div class="mt-8 px-6">
        <h2 class="text-2xl font-bold text-[#4C4C4C] mb-6">Pacientes Registrados</h2>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-[#9C1C2A] text-white">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Documento</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Nombres</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Apellidos</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Sexo</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Edad</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($pacientes as $paciente)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $paciente->documento }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $paciente->nombres }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $paciente->apellidos }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $paciente->sexo }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $paciente->edad ?? '—' }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('historiaClinica.editar', ['dni' => $paciente->documento, 'from' => 'pacientes']) }}"
                                   class="inline-block bg-[#9C1C2A] text-white text-sm px-4 py-1 rounded hover:bg-[#7C1A24]">
                                    Ver Historia Clínica
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-sm text-gray-500">
                                No hay pacientes registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-clinico-layout>

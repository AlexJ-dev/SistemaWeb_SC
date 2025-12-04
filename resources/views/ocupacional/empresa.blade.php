<x-clinico-layout>
    <x-encabezado-clinico />
    <div class="bg-white shadow-md rounded-lg px-6 mt-8 py-6">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-xl font-semibold text-gray-700">Empresas Registradas</h1>
            <a href="{{ route('empresa.crear') }}"
                class="bg-[#9C1C2A] text-white px-4 py-2 rounded-lg hover:bg-[#b91c1c] transition">
                Nueva Empresa
            </a>
        </div>

        <table class="w-full border-collapse">
            <thead class="bg-[#9C1C2A] text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Razón Social</th>
                    <th class="px-4 py-2 text-left">N.Abreviado</th>
                    <th class="px-4 py-2 text-left">RUC</th>
                    <th class="px-4 py-2 text-left">Dirección</th>
                    <th class="px-4 py-2 text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($empresas as $empresa)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $empresa->nombre }}</td>
                    <td class="px-4 py-2">{{ $empresa->nombre_abreviado }}</td>
                    <td class="px-4 py-2">{{ $empresa->ruc }}</td>
                    <td class="px-4 py-2">{{ $empresa->direccion }}</td>

                    <td class="px-4 py-2 text-center">
                        <a href="{{ route('empresa.editar', $empresa->id) }}"
                            class="text-[#9C1C2A] hover:underline hover:text-[#b91c1c]">
                            Editar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-clinico-layout>
<x-clinico-layout>
    <x-encabezado-clinico />
    <div class="mt-8 px-6">
        <p class="text-lg text-[#4C4C4C] mt-2">
            Panel de mantenimiento
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <a href="{{ route('ocupacional.mantenimiento.especialidades.index') }}" class="block p-6 bg-white shadow rounded hover:bg-gray-50 border border-gray-200">
                <h3 class="text-lg font-semibold text-[#9C1C2A] mb-2">Especialidades</h3>
                <p class="text-sm text-[#4C4C4C]">Agregar, editar o eliminar especialidades clínicas.</p>
            </a>

            <a href="" class="block p-6 bg-white shadow rounded hover:bg-gray-50 border border-gray-200">
                <h3 class="text-lg font-semibold text-[#9C1C2A] mb-2">Usuarios</h3>
                <p class="text-sm text-[#4C4C4C]">Administrar médicos, recepcionistas y personal institucional.</p>
            </a>
        </div>
    </div>
</x-clinico-layout>
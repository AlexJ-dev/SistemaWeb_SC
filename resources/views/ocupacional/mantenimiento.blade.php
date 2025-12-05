<x-clinico-layout>
    <x-encabezado-clinico />
    <div class="bg-white shadow-md rounded-lg px-6 mt-8 py-6">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-xl font-semibold text-gray-700">Empresas Registradas</h1>
            
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            <a href="{{ route('ocupacional.mantenimiento.especialidades.index') }}" class="block p-6 bg-white shadow rounded hover:bg-gray-50 border border-gray-200">
                <h3 class="text-lg font-semibold text-[#9C1C2A] mb-2">Especialidades</h3>
                <p class="text-sm text-[#4C4C4C]">Agregar, editar o eliminar especialidades clínicas.</p>
            </a>

            <a href="{{ route('ocupacional.mantenimiento.personal.index') }}" class="block p-6 bg-white shadow rounded hover:bg-gray-50 border border-gray-200">
                <h3 class="text-lg font-semibold text-[#9C1C2A] mb-2">Personal</h3>
                <p class="text-sm text-[#4C4C4C]">Registrar médicos, recepcionistas y personal institucional.</p>
            </a>

            <a href="{{ route('ocupacional.mantenimiento.roles.index') }}" class="block p-6 bg-white shadow rounded hover:bg-gray-50 border border-gray-200">
                <h3 class="text-lg font-semibold text-[#9C1C2A] mb-2">Roles</h3>
                <p class="text-sm text-[#4C4C4C]">Definir y administrar roles clínicos para usuarios del sistema.</p>
            </a>

            <a href="{{ route('ocupacional.mantenimiento.usuarios.index') }}" class="block p-6 bg-white shadow rounded hover:bg-gray-50 border border-gray-200">
                <h3 class="text-lg font-semibold text-[#9C1C2A] mb-2">Usuarios</h3>
                <p class="text-sm text-[#4C4C4C]">Crear y gestionar usuarios del sistema con roles asignados.</p>
            </a>

            <a href="{{ route('areas.index') }}" class="block p-6 bg-white shadow rounded hover:bg-gray-50 border border-gray-200">
                <h3 class="text-lg font-semibold text-[#9C1C2A] mb-2">Áreas Ocupacionales</h3>
                <p class="text-sm text-[#4C4C4C]">Registrar y administrar las áreas ocupacionales de la clínica.</p>
            </a>

        </div>
    </div>
</x-clinico-layout>

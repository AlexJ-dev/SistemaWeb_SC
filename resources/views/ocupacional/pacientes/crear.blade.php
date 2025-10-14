<x-clinico-layout>
    <x-encabezado-clinico />

    <div class="mt-8 px-6">
        <h2 class="text-2xl font-bold text-[#4C4C4C] mb-4">Registro de Paciente</h2>

        <form action="{{ route('pacientes.store') }}" method="POST" class="bg-white rounded-lg shadow p-6 space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input-clinico label="Nombres" name="nombres" />
                <x-input-clinico label="Apellidos" name="apellidos" />
                <x-input-clinico label="Cargo" name="cargo" />
                <x-input-clinico label="Empresa" name="empresa" />
                <x-input-clinico label="Fecha" name="fecha" type="date" />
                <x-input-clinico label="N° Documento" name="documento" />
                <x-select-clinico label="Tipo de documento" name="tipo_documento" :options="[
                    'DNI' => 'DNI',
                    'C. Extranjería' => 'C. Extranjería',
                    'Pasaporte' => 'Pasaporte'
                ]" />
            </div>

            <x-radio-evaluacion />

            <div class="flex justify-end space-x-4 pt-6">
                <x-boton-clinico>Guardar</x-boton-clinico>
                <x-boton-clinico-link>Salir</x-boton-clinico-link>

            </div>
        </form>
    </div>
</x-clinico-layout>

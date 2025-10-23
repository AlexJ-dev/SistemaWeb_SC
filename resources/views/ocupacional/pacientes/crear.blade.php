<x-clinico-layout>
    <x-encabezado-clinico />

    <div class="mt-8 px-6">
        

        <form action="{{ route('ruta.store') }}" method="POST" class="bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-xl font-semibold text-[#4C4C4C]">Registro de ruta medica</h2>
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input-clinico label="Nombres" name="nombres" />
                <x-input-clinico label="Apellidos" name="apellidos" />
                <x-input-clinico label="Cargo" name="cargo" />
                <x-input-clinico label="Empresa" name="empresa" />
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

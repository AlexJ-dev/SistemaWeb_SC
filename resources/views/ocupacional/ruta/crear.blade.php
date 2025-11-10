<x-clinico-layout>
    <x-encabezado-clinico />
    <div class="mt-8 px-6">
        <form id="rutaForm" action="{{ route('ruta.store') }}" method="POST" class="bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-xl font-semibold text-[#4C4C4C]">Registro de ruta médica</h2>
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input-clinico label="Nombres" name="nombres" required id="nombres"/>
                <x-input-clinico label="Apellidos" name="apellidos" required id="apellidos"/>
                <x-input-clinico label="Cargo" name="cargo" required id="cargo"/>
                <x-input-clinico label="Empresa" name="empresa" required id="empresa"/>

                <div>
                    <x-input-clinico label="N° Documento" name="documento" id="documento" required />
                    <p id="error-documento" class="text-red-600 text-sm mt-1 hidden"></p>
                </div>

                <div>
                    <x-select-clinico
                        label="Tipo de documento"
                        name="tipo_documento"
                        id="tipo_documento"
                        :options="[
                            'DNI' => 'DNI',
                            'C. Extranjería' => 'C. Extranjería',
                            'Pasaporte' => 'Pasaporte'
                        ]"
                        required /> 
                </div>
            </div>

            <x-radio-evaluacion required />

            <div class="flex justify-end space-x-4 pt-6">
                <x-boton-clinico>Guardar</x-boton-clinico>
                <x-boton-clinico-link>Salir</x-boton-clinico-link>
            </div>
        </form>
    </div>
</x-clinico-layout>
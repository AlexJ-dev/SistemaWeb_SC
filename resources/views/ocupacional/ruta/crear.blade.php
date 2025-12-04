<x-clinico-layout>
    <x-encabezado-clinico />
    <div class="mt-8 px-6">
        @if (session('error'))
        <div class="px-4 py-3 rounded mb-4 bg-[#FDECEA] border border-[#F5C6CB] text-[#9C1C2A]">
            {{ session('error') }}
        </div>
        @endif

        <form id="rutaForm" action="{{ route('ruta.store') }}" method="POST" class="bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-xl font-semibold text-[#4C4C4C]">Registro de ruta médica</h2>
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input-clinico label="Nombres" name="nombres" required id="nombres" />
                <x-input-clinico label="Apellidos" name="apellidos" required id="apellidos" />
                <x-input-clinico label="Cargo" name="cargo" required id="cargo" />

                <div class="flex gap-2 items-center">
                    <x-input-clinico label="Empresa" name="empresa" id="empresa" required />

                    <button type="button"
                        onclick="abrirModalEmpresa('empresa')"
                        class="px-3 h-[42px] bg-[#9C1C2A] text-white rounded shadow mt-1">
                        Seleccionar
                    </button>
                </div>

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
@php
$paciente = $historia->paciente;
@endphp

{{-- =========================
      Datos del Paciente
   ========================= --}}
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h3 class="text-lg font-semibold text-[#4C4C4C] mb-4">Datos del Paciente</h3>



    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <x-input-clinico label="Nombres" name="paciente[nombres]"
            :value="old('paciente.nombres', $paciente->nombres ?? '')" />
        <x-input-clinico label="Apellidos" name="paciente[apellidos]"
            :value="old('paciente.apellidos', $paciente->apellidos ?? '')" />
        <x-select-clinico
            label="Tipo de Documento"
            name="paciente[tipo_documento]"
            :options="[
            'DNI' => 'DNI',
            'C. Extranjeria' => 'C. Extranjeria',
            'Pasaporte' => 'Pasaporte', ]"

            :value="old('paciente.tipo_documento', $paciente->tipo_documento ?? '')">
            <option value="" disabled selected>Seleccione</option>
        </x-select-clinico>
        <x-input-clinico label="N° Documento" name="paciente[documento]"
            :value="old('paciente.documento', $paciente->documento ?? '')" />
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-input-clinico label="Fecha de Nacimiento" name="paciente[fecha_nacimiento]" type="date"
                :value="old('paciente.fecha_nacimiento', $paciente->fecha_nacimiento ?? '')"
                id="fecha_nacimiento" />

            <x-input-clinico label="Edad" name="paciente[edad]"
                :value="old('paciente.edad', $paciente->edad ?? '')"
                id="edad" readonly />
        </div>
        <x-select-clinico
            label="Sexo"
            name="paciente[sexo]"
            :options="['M' => 'Masculino', 'F' => 'Femenino']"
            :value="old('paciente.sexo', $paciente->sexo ?? '')">
            <option value="" disabled selected>Seleccione</option>
        </x-select-clinico>
        <x-input-clinico
            label="Teléfono"
            name="paciente[telefono]"
            type="text"
            :value="old('paciente.telefono', $paciente->telefono ?? '')"
            id="telefono" />
        <x-input-clinico label="Correo Electrónico" name="paciente[correo_electronico]" type="email"
            :value="old('paciente.correo_electronico', $paciente->correo_electronico ?? '')" />
    </div>
</div>
{{-- Lugar de Nacimiento --}}
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h3 class="text-lg font-semibold text-[#4C4C4C] mb-4 pb-2">Lugar de Nacimiento</h3>

    {{-- País --}}
    <div class="mb-4">
        <x-input-clinico label="País de Nacimiento" name="historia[lugar_nacimiento_pais]" :value="old('historia.lugar_nacimiento_pais', $historia->lugar_nacimiento_pais)" horizontal />
    </div>

    {{-- Departamento / Provincia / Distrito --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        {{-- Departamento --}}
        <div class="flex flex-col md:flex-row items-center gap-2 mb-4">

            <x-input-clinico
                id="input_departamento"
                label="Departamento Seleccionado"
                name="historia[lugar_nacimiento_departamento]"
                :value="old('historia.lugar_nacimiento_departamento', $historia->lugar_nacimiento_departamento)"
                readonly
                class="w-full" />

            <div class="relative">
                <select
                    id="departamento"
                    data-old="{{ old('historia.lugar_nacimiento_departamento', $historia->lugar_nacimiento_departamento) }}"
                    class="border border-gray-300 focus:border-[#9C1C2A] focus:ring-[#9C1C2A] rounded-md h-[42px] w-[42px] cursor-pointer bg-gray-300 mt-2">
                    <option value="">▼</option>
                </select>
            </div>
        </div>

        {{-- Provincia --}}
        <div class="flex flex-col md:flex-row items-center gap-2 mb-4">

            <x-input-clinico
                id="input_provincia"
                label="Provincia Seleccionada"
                name="historia[lugar_nacimiento_provincia]"
                :value="old('historia.lugar_nacimiento_provincia', $historia->lugar_nacimiento_provincia)"
                readonly
                class="w-full" />

            <div class="relative">
                <select
                    id="provincia"
                    data-old="{{ old('historia.lugar_nacimiento_provincia', $historia->lugar_nacimiento_provincia) }}"
                    class="border border-gray-300 focus:border-[#9C1C2A] focus:ring-[#9C1C2A] rounded-md h-[42px] w-[42px] cursor-pointer bg-gray-300 mt-2">
                    <option value="">▼</option>
                </select>
            </div>
        </div>

        {{-- Distrito --}}
        <div class="flex flex-col md:flex-row items-center gap-2 mb-4">

            <x-input-clinico
                id="input_distrito"
                label="Distrito Seleccionado"
                name="historia[lugar_nacimiento_distrito]"
                :value="old('historia.lugar_nacimiento_distrito', $historia->lugar_nacimiento_distrito)"
                readonly
                class="w-full" />
            <div class="relative">
                <select
                    id="distrito"
                    data-old="{{ old('historia.lugar_nacimiento_distrito', $historia->lugar_nacimiento_distrito) }}"
                    class="border border-gray-300 focus:border-[#9C1C2A] focus:ring-[#9C1C2A] rounded-md h-[42px] w-[42px] cursor-pointer bg-gray-300 mt-2">
                    <option value="">▼</option>
                </select>
            </div>
        </div>
    </div>

</div>

{{-- Domicilio Actual --}}
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h3 class="text-lg font-semibold text-[#4C4C4C] mb-4 pb-2">Domicilio Actual</h3>

    {{-- Dirección --}}
    <div class="mb-4">
        <x-input-clinico
            label="Dirección Actual"
            name="historia[domicilio_direccion]"
            :value="old('historia.domicilio_direccion', $historia->domicilio_direccion)" />
    </div>

    {{-- Departamento / Provincia / Distrito --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        {{-- Departamento --}}
        <div class="flex flex-col md:flex-row items-center gap-2 mb-4">
            <x-input-clinico
                id="input_domicilio_departamento"
                label="Departamento (Domicilio)"
                name="historia[domicilio_departamento]"
                :value="old('historia.domicilio_departamento', $historia->domicilio_departamento)"
                readonly
                class="w-full" />

            <div class="relative">
                <select
                    id="domicilio_departamento"
                    data-old="{{ old('historia.domicilio_departamento', $historia->domicilio_departamento) }}"
                    class="border border-gray-300 focus:border-[#9C1C2A] focus:ring-[#9C1C2A] rounded-md h-[42px] w-[42px] cursor-pointer bg-gray-300 mt-2">
                    <option value="">▼</option>
                </select>
            </div>
        </div>

        {{-- Provincia --}}
        <div class="flex flex-col md:flex-row items-center gap-2 mb-4">
            <x-input-clinico
                id="input_domicilio_provincia"
                label="Provincia (Domicilio)"
                name="historia[domicilio_provincia]"
                :value="old('historia.domicilio_provincia', $historia->domicilio_provincia)"
                readonly
                class="w-full" />

            <div class="relative">
                <select
                    id="domicilio_provincia"
                    data-old="{{ old('historia.domicilio_provincia', $historia->domicilio_provincia) }}"
                    class="border border-gray-300 focus:border-[#9C1C2A] focus:ring-[#9C1C2A] rounded-md h-[42px] w-[42px] cursor-pointer bg-gray-300 mt-2">
                    <option value="">▼</option>
                </select>
            </div>
        </div>

        {{-- Distrito --}}
        <div class="flex flex-col md:flex-row items-center gap-2 mb-4">
            <x-input-clinico
                id="input_domicilio_distrito"
                label="Distrito (Domicilio)"
                name="historia[domicilio_distrito]"
                :value="old('historia.domicilio_distrito', $historia->domicilio_distrito)"
                readonly
                class="w-full" />

            <div class="relative">
                <select
                    id="domicilio_distrito"
                    data-old="{{ old('historia.domicilio_distrito', $historia->domicilio_distrito) }}"
                    class="border border-gray-300 focus:border-[#9C1C2A] focus:ring-[#9C1C2A] rounded-md h-[42px] w-[42px] cursor-pointer bg-gray-300 mt-2">
                    <option value="">▼</option>
                </select>
            </div>
        </div>
    </div>
</div>



{{--Información Personal --}}
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h3 class="text-lg font-semibold text-[#4C4C4C] mb-4 pb-4">Información Personal</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <x-select-clinico
            label="Estado Civil"
            name="historia[estado_civil]"
            :options="[
            ' ' => ' ',
            'Soltero' => 'Soltero(a)',
            'Casado' => 'Casado(a)',
            'Conviviente' => 'Conviviente',
            'Viudo' => 'Viudo(a)',
            'Divorciado' => 'Divorciado(a)'
        ]"
            :value="old('historia.estado_civil', $historia->estado_civil ?? '')">
            <option value="" disabled selected>Seleccione estado civil</option>
        </x-select-clinico>

        <x-select-clinico
            label="Grado Institucional"
            name="historia[grado_institucional]"
            :options="[
            ' ' => ' ',
            'Analfabeto' => 'Analfabeto',
            'Primaria Incompleta' => 'Primaria Incompleta',
            'Primaria Completa' => 'Primaria Completa',
            'Secundaria Incompleta' => 'Secundaria Incompleta',
            'Secundaria Completa' => 'Secundaria Completa',
            'Técnico' => 'Técnico',
            'Universitario' => 'Universitario'
        ]"
            :value="old('historia.grado_institucional', $historia->grado_institucional ?? '')">
            <option value="" disabled selected>Seleccione grado</option>
        </x-select-clinico>

        <x-input-clinico label="Ocupación" name="historia[ocupacion]"
            :value="old('historia.ocupacion', $historia->ocupacion)" />
        <x-input-clinico label="Religión" name="historia[religion]"
            :value="old('historia.religion', $historia->religion)" />
        <x-input-clinico label="Seguro" name="historia[seguro]"
            :value="old('historia.seguro', $historia->seguro)" />
        <x-input-clinico label="Licencia de Conducir" name="historia[licencia_conducir]"
            :value="old('historia.licencia_conducir', $historia->licencia_conducir)" />
    </div>
</div>


{{-- Contacto de Emergencia --}}
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h3 class="text-lg font-semibold text-[#4C4C4C] mb-4 pb-2">Contacto de Emergencia</h3>

    <div class="mb-4">
        <x-input-clinico
            label="Persona de contacto"
            name="historia[emergencia_persona]"
            :value="old('historia.emergencia_persona', $historia->emergencia_persona)" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <x-input-clinico
            label="Parentesco"
            name="historia[emergencia_parentesco]"
            :value="old('historia.emergencia_parentesco', $historia->emergencia_parentesco)" />
        <x-input-clinico
            label="Teléfono"
            name="historia[emergencia_telefono]"
            :value="old('historia.emergencia_telefono', $historia->emergencia_telefono)" />
        <x-input-clinico
            label="Dirección"
            name="historia[emergencia_direccion]"
            :value="old('historia.emergencia_direccion', $historia->emergencia_direccion)" />
    </div>
</div>
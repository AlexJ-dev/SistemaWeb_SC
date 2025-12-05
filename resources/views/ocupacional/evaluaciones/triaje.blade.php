<form action="{{ route('triaje.store', $evaluacion->id) }}" method="POST"
    class="max-w-8xl mx-auto bg-white p-4 rounded-lg shadow-lg">
    @csrf

    <div class="flex flex-col lg:flex-row gap-4">

        {{-- --------------- SECCIÓN 1: FUNCIONES VITALES --------------- --}}
        <div class="space-y-3 p-4 border border-gray-300 rounded w-full">
            <h2 class="text-xl font-bold text-red-800 mb-6">
                1. Funciones Vitales y Medidas
            </h2>

            <div class="space-y-2">
                <x-input-clinico-suffix label="Talla" name="talla" type="number" suffix="cm" step="0.01" min="0"
                    value="{{ old('talla', $triaje->talla ?? '') }}" />

                <x-input-clinico-suffix label="Peso" name="peso" type="number" suffix="kg" step="0.01" min="0"
                    value="{{ old('peso', $triaje->peso ?? '') }}" />

                <x-input-clinico-suffix label="Índice de Masa Corporal" name="indice_masa_corporal" step="0.01" min="0"
                    type="number" step="0.01" suffix="IMC"
                    value="{{ old('indice_masa_corporal', $triaje->indice_masa_corporal ?? '') }}" />

                <x-input-clinico-suffix label="Frecuencia Respiratoria" name="frecuencia_respiratoria" step="0.01" min="0"
                    type="number" suffix="x min"
                    value="{{ old('frecuencia_respiratoria', $triaje->frecuencia_respiratoria ?? '') }}" />

                <x-input-clinico-suffix label="Frecuencia Cardiaca" name="frecuencia_cardiaca" step="0.01" min="0"
                    type="number" suffix="x min"
                    value="{{ old('frecuencia_cardiaca', $triaje->frecuencia_cardiaca ?? '') }}" />

                <x-input-clinico-suffix label="Saturación de Oxígeno" name="saturacion_oxigeno" step="0.01" min="0"
                    type="number" suffix="%"
                    value="{{ old('saturacion_oxigeno', $triaje->saturacion_oxigeno ?? '') }}" />

                <x-input-clinico-suffix label="Presión Arterial" name="presion_arterial" type="text" step="0.01" min="0"
                    suffix="mmHg"
                    value="{{ old('presion_arterial', $triaje->presion_arterial ?? '') }}" />

                <x-input-clinico-suffix label="Temperatura" name="temperatura" type="number" step="0.01" min="0"
                    step="0.1" suffix="°C"
                    value="{{ old('temperatura', $triaje->temperatura ?? '') }}" />

                <x-input-clinico-suffix label="Perímetro Torácico" name="perimetro_toracico" step="0.01" min="0"
                    type="number" suffix="cm"
                    value="{{ old('perimetro_toracico', $triaje->perimetro_toracico ?? '') }}" />

                <x-input-clinico-suffix label="Perímetro Abdominal" name="perimetro_abdominal" step="0.01" min="0"
                    type="number" suffix="cm"
                    value="{{ old('perimetro_abdominal', $triaje->perimetro_abdominal ?? '') }}" />

                <x-input-clinico-suffix label="Cintura" name="cintura" step="0.01" min="0"
                    type="number" suffix="cm"
                    value="{{ old('cintura', $triaje->cintura ?? '') }}" />

                <x-input-clinico-suffix label="Cadera" name="cadera" step="0.01" min="0"
                    type="number" suffix="cm"
                    value="{{ old('cadera', $triaje->cadera ?? '') }}" />

                <x-input-clinico-suffix label="Índice Cintura Cadera" name="indice_cintura_cadera" min="0"
                    type="number" step="0.01" suffix="ICC"
                    value="{{ old('indice_cintura_cadera', $triaje->indice_cintura_cadera ?? '') }}" />
            </div>

        </div>
        {{-- --------------- SECCIÓN 2: EXAMEN CLÍNICO --------------- --}}
        <div class="w-full space-y-6 p-4 border border-gray-300 rounded">
            <h2 class="text-xl font-bold text-red-800 mb-6">
                2. Examen Clínico
            </h2>

            <div class="space-y-4">
                <x-textarea-clinico label="Anamnesis" name="anamnesis" rows="1"
                    value="{{ old('anamnesis', $triaje->anamnesis ?? '') }}" />

                <x-textarea-clinico label="Ectoscopia" name="ectoscopia" rows="1"
                    value="{{ old('ectoscopia', $triaje->ectoscopia ?? '') }}" />

                <x-textarea-clinico label="Estado Mental" name="estado_mental" rows="1"
                    value="{{ old('estado_mental', $triaje->estado_mental ?? '') }}" />
            </div>
        </div>

    </div>

    {{--- BOTÓN EN LA PARTE INFERIOR ---}}
    <div class="mt-8 flex justify-end">
        <button type="submit"
            class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-6 rounded shadow-md transition duration-150 ease-in-out flex items-center space-x-2">
            <span>Guardar</span>
        </button>
    </div>

</form>

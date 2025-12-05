

<form action="{{ route('evaluaciones.audiometria.store', $evaluacion->id) }}" method="POST">
    @csrf

    {{-- SECCIÓN 1 DATOS GENERALES --}}
    <div class="bg-white rounded-lg border border-gray-400 p-4 mb-6">

        {{-- FILA: AÑOS DE TRABAJO + TEP --}}
        <div class="flex flex-col md:flex-row md:items-center gap-4 mb-4">
            <div class="flex items-center gap-2">
                <label for="anios_trabajo" class="font-medium whitespace-nowrap">
                    Años de Trabajo:
                </label>
                <input type="number"
                    id="anios_trabajo"
                    name="anios_trabajo"
                    class="w-full border border-gray-500 p-1 rounded-md focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                    value="{{ old('anios_trabajo', $audiometria->anios_trabajo ?? '') }}">
            </div>

            <div class="flex items-center gap-2">
                <label for="tep" class="font-medium whitespace-nowrap">
                    Tiempo de Exposición Total Ponderado (TEP):
                </label>
                <input type="text"
                    id="tep"
                    name="tep"
                    class="w-full border border-gray-500 p-1 rounded-md focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                    value="{{ old('tep', $audiometria->tep ?? '') }}">
            </div>
        </div>

        {{-- USO DE PROTECTORES AUDITIVOS --}}
        <div class="mb-4">
            <div class="font-medium mb-2">Uso de Protectores Auditivos:</div>
            <div class="flex space-x-6">
                <label class="inline-flex items-center">
                    <input type="checkbox"
                        name="uso_tapones"
                        value="1"
                        class="rounded border-gray-300 text-[#9C1C2A] focus:ring-[#9C1C2A]"
                        {{ old('uso_tapones', $audiometria->uso_tapones ?? false) ? 'checked' : '' }}>
                    <span class="ml-2">Tapones</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox"
                        name="uso_orejeras"
                        value="1"
                        class="rounded border-gray-300 text-[#9C1C2A] focus:ring-[#9C1C2A]"
                        {{ old('uso_orejeras', $audiometria->uso_orejeras ?? false) ? 'checked' : '' }}>
                    <span class="ml-2">Orejeras</span>
                </label>
            </div>
        </div>

        {{-- APRECIACIÓN DEL RUIDO --}}
        <div>
            <div class="font-medium mb-2">Apreciación del Ruido:</div>
            <div class="flex flex-col md:flex-row md:space-x-6 space-y-2 md:space-y-0">

                <label class="inline-flex items-center">
                    <input type="radio"
                        name="apreciacion_ruido"
                        value="muy_intenso"
                        class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                        {{ old('apreciacion_ruido', $audiometria->apreciacion_ruido ?? '') == 'muy_intenso' ? 'checked' : '' }}>
                    <span class="ml-2">Ruido muy intenso</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="radio"
                        name="apreciacion_ruido"
                        value="moderado"
                        class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                        {{ old('apreciacion_ruido', $audiometria->apreciacion_ruido ?? '') == 'moderado' ? 'checked' : '' }}>
                    <span class="ml-2">Ruido moderado</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="radio"
                        name="apreciacion_ruido"
                        value="no_molesto"
                        class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                        {{ old('apreciacion_ruido', $audiometria->apreciacion_ruido ?? '') == 'no_molesto' ? 'checked' : '' }}>
                    <span class="ml-2">Ruido no molesto</span>
                </label>

            </div>
        </div>

    </div>

    {{-- SECCIÓN CRITERIOS PARA LA AUDIOMETRÍA --}}
    <div class="p-5 border border-gray-300 rounded-lg bg-gray-50 mb-6">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Requisitos para pasar la audiometría</h2>

        <div class="overflow-x-auto">
            <table class="table-auto w-full text-center border border-black">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-black w-12 px-2 py-2 font-bold">N°</th>
                        <th class="border border-black px-2 py-2 text-left font-bold">
                            Todas las respuestas deben ser NO, si no se posterga
                        </th>
                        <th class="border border-black w-16 font-bold">SI</th>
                        <th class="border border-black w-16 font-bold">NO</th>
                    </tr>
                </thead>

                @php
                $criterios = [
                1 => ['texto' => '¿Ha tenido un cambio de altitud geográfica mayor de 100 m en los últimos 2 días?', 'campo' => 'cambio_altitud'],
                2 => ['texto' => '¿Se ha expuesto a ruidos en las últimas 24 horas previas?', 'campo' => 'exposicion_ruidos'],
                3 => ['texto' => '¿Presenta infección o inflamación de oído o garganta?', 'campo' => 'malestar_oido_garganta'],
                4 => ['texto' => '¿Ha tenido problemas para dormir la noche previa?', 'campo' => 'problema_dormir'],
                5 => ['texto' => '¿Ha consumido alcohol el día previo?', 'campo' => 'consume_alcohol'],
                6 => ['texto' => '¿Usa medicamentos que influyen en la prueba?', 'campo' => 'uso_medicamentos'],
                ];
                @endphp

                <tbody>
                    @foreach($criterios as $i => $item)

                    @php
                    $value = old($item['campo'], $audiometria?->{$item['campo']} ?? null);
                    @endphp

                    <tr>
                        <td class="border border-black text-center align-middle">{{ $i }}</td>

                        <td class="border border-black px-2 py-2 text-left">{{ $item['texto'] }}</td>

                        <!-- SI -->
                        <td class="border border-black align-middle">
                            <input type="radio"
                                name="{{ $item['campo'] }}"
                                value="1"
                                class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                {{ $value == 1 ? 'checked' : '' }}>
                        </td>

                        <!-- NO -->
                        <td class="border border-black align-middle">
                            <input type="radio"
                                name="{{ $item['campo'] }}"
                                value="0"
                                class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                {{ $value == 0 ? 'checked' : '' }}>
                        </td>
                    </tr>

                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

    {{-- SECCIÓN  ANTECEDENTES --}}
    <div class="p-5 border border-gray-300 rounded-lg bg-gray-50 mb-6">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Antecedentes relacionados</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Tabla 1 --}}
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-center border border-black">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-black w-12 font-bold">N°</th>
                            <th class="border border-black px-2 py-2 text-left font-bold">Antecedente</th>
                            <th class="border border-black w-16 font-bold">SI</th>
                            <th class="border border-black w-16 font-bold">NO</th>
                        </tr>
                    </thead>

                    @php
                    $antecedentes = [
                    1 => ['texto' => 'Consumo de tabaco', 'campo' => 'consume_tabaco'],
                    2 => ['texto' => 'Servicio militar', 'campo' => 'servicio_militar'],
                    3 => ['texto' => 'Hobbies con exposición a ruido', 'campo' => 'hobbi_exposicion_ruido'],
                    4 => ['texto' => 'Exposición laboral a químicos', 'campo' => 'exposicion_laboral_quimicos'],
                    5 => ['texto' => 'Infecciones de oído', 'campo' => 'infecciones_oido'],
                    6 => ['texto' => 'Uso de ototóxicos', 'campo' => 'uso_ototoxicos'],
                    ];
                    @endphp

                    <tbody>
                        @foreach($antecedentes as $i => $item)

                        @php
                        // Recupera el valor enviado o el valor guardado en la BD
                        $value = old($item['campo'], $audiometria?->{$item['campo']} ?? null);
                        @endphp

                        <tr>
                            <td class="border border-black text-center">{{ $i }}</td>
                            <td class="border border-black px-2 py-2 text-left">{{ $item['texto'] }}</td>

                            <!-- SI -->
                            <td class="border border-black">
                                <input
                                    type="radio"
                                    name="{{ $item['campo'] }}"
                                    value="1"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ $value == 1 ? 'checked' : '' }}>
                            </td>

                            <!-- NO -->
                            <td class="border border-black">
                                <input
                                    type="radio"
                                    name="{{ $item['campo'] }}"
                                    value="0"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ $value == 0 ? 'checked' : '' }}>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>

                </table>
            </div>


            {{-- Tabla 2 --}}
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-center border border-black">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-black w-12 font-bold">N°</th>
                            <th class="border border-black px-2 py-2 text-left font-bold">Síntoma</th>
                            <th class="border border-black w-16 font-bold">SI</th>
                            <th class="border border-black w-16 font-bold">NO</th>
                        </tr>
                    </thead>

                    @php
                    $sintomas = [
                    1 => ['texto' => 'Disminución de audición', 'campo' => 'disminucion_audicion'],
                    2 => ['texto' => 'Otalgia', 'campo' => 'otalgia'],
                    3 => ['texto' => 'Zumbido', 'campo' => 'zumbido'],
                    4 => ['texto' => 'Mareos', 'campo' => 'mareos'],
                    5 => ['texto' => 'Secreción de oído', 'campo' => 'secrecion_oido'],
                    6 => ['texto' => 'Otros', 'campo' => 'otros'],
                    ];
                    @endphp

                    <tbody>
                        @foreach($sintomas as $i => $item)

                        @php
                        // Recupera el valor anterior o el valor guardado (1 o 0)
                        $value = old($item['campo'], $audiometria?->{$item['campo']} ?? null);
                        @endphp

                        <tr>
                            <td class="border border-black text-center">{{ $i }}</td>
                            <td class="border border-black px-2 py-2 text-left">{{ $item['texto'] }}</td>

                            <!-- SI -->
                            <td class="border border-black">
                                <input type="radio"
                                    name="{{ $item['campo'] }}"
                                    value="1"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ $value == 1 ? 'checked' : '' }}>
                            </td>

                            <!-- NO -->
                            <td class="border border-black">
                                <input type="radio"
                                    name="{{ $item['campo'] }}"
                                    value="0"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ $value == 0 ? 'checked' : '' }}>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>

                </table>
            </div>


        </div>


    </div>



    {{-- OTOSCOPIA --}}
    <div class="bg-white rounded-lg border border-gray-400 p-4 mt-6">

        <!-- Título central -->
        <h2 class="text-center text-xl font-bold text-red-800 mb-6">EXAMEN OTOSCOPIA</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- PARTE IZQUIERDA – OÍDOS --}}
            <div class="border border-gray-400 rounded-lg p-4">

                {{-- OÍDO DERECHO --}}
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-3">Oído Derecho</h3>

                    <textarea name="otoscopia_oido_der"
                        class="w-full border border-gray-500 p-2 rounded-md focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                        rows="3">{{ old('otoscopia_oido_der', $audiometria->otoscopia_oido_der ?? '') }}</textarea>

                    <p class="text-sm text-gray-600 mt-1">
                        Ejemplo: "Pabellón Auricular Normal | Ausencia de Cerumen | Tímpano Normal"
                    </p>
                </div>

                {{-- OÍDO IZQUIERDO --}}
                <div>
                    <h3 class="text-lg font-semibold mb-3">Oído Izquierdo</h3>

                    <textarea name="otoscopia_oido_izq"
                        class="w-full border border-gray-500 p-2 rounded-md focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                        rows="3">{{ old('otoscopia_oido_izq', $audiometria->otoscopia_oido_izq ?? '') }}</textarea>

                    <p class="text-sm text-gray-600 mt-1">
                        Ejemplo: "Pabellón Auricular Normal | Ausencia de Cerumen | Tímpano Normal"
                    </p>
                </div>

            </div>


            {{-- PARTE DERECHA – TABLA DE ANTECEDENTES --}}
            <div class="border border-gray-400 rounded-lg p-4">

                <div class="overflow-x-auto">
                    <table class="w-full text-center border border-black">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-black px-4 py-2 font-bold"></th>
                                <th class="border border-black px-4 py-2 font-bold">SI</th>
                                <th class="border border-black px-4 py-2 font-bold">NO</th>
                            </tr>
                        </thead>

                        <tbody>

                            {{-- PRACTICA TIRO --}}
                            @php $value = old('practica_tiro', $audiometria->practica_tiro ?? null); @endphp
                            <tr>
                                <td class="border border-black px-2 py-1 text-left">Practica Tiro</td>

                                <td class="border border-black align-middle">
                                    <input
                                        type="radio"
                                        name="practica_tiro"
                                        value="1"
                                        class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                        {{ $value == 1 ? 'checked' : '' }}>
                                </td>

                                <td class="border border-black align-middle">
                                    <input
                                        type="radio"
                                        name="practica_tiro"
                                        value="0"
                                        class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                        {{ $value == 0 ? 'checked' : '' }}>
                                </td>
                            </tr>

                            {{-- USA AURICULARES --}}
                            @php $value = old('usa_auriculares', $audiometria->usa_auriculares ?? null); @endphp
                            <tr>
                                <td class="border border-black px-2 py-1 text-left">Usa Auriculares</td>

                                <td class="border border-black align-middle">
                                    <input
                                        type="radio"
                                        name="usa_auriculares"
                                        value="1"
                                        class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                        {{ $value == 1 ? 'checked' : '' }}>
                                </td>

                                <td class="border border-black align-middle">
                                    <input
                                        type="radio"
                                        name="usa_auriculares"
                                        value="0"
                                        class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                        {{ $value == 0 ? 'checked' : '' }}>
                                </td>
                            </tr>

                            {{-- SORDERA FAMILIAR --}}
                            @php $value = old('sordera_familiar', $audiometria->sordera_familiar ?? null); @endphp
                            <tr>
                                <td class="border border-black px-2 py-1 text-left">Sordera Familiar</td>

                                <td class="border border-black align-middle">
                                    <input
                                        type="radio"
                                        name="sordera_familiar"
                                        value="1"
                                        class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                        {{ $value == 1 ? 'checked' : '' }}>
                                </td>

                                <td class="border border-black align-middle">
                                    <input
                                        type="radio"
                                        name="sordera_familiar"
                                        value="0"
                                        class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                        {{ $value == 0 ? 'checked' : '' }}>
                                </td>
                            </tr>

                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>


    {{-- FRECUENCIAS (DERECHO + IZQUIERDO) --}}
    <div class="overflow-x-auto">
        <table class="table-auto w-full text-center border border-black">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-black px-2 py-1 font-bold w-1/4">FRECUENCIAS</th>
                    <th class="border border-black px-2 py-1 font-bold">500</th>
                    <th class="border border-black px-2 py-1 font-bold">1000</th>
                    <th class="border border-black px-2 py-1 font-bold">2000</th>
                    <th class="border border-black px-2 py-1 font-bold">3000</th>
                    <th class="border border-black px-2 py-1 font-bold">4000</th>
                    <th class="border border-black px-2 py-1 font-bold">6000</th>
                    <th class="border border-black px-2 py-1 font-bold">8000</th>
                </tr>
            </thead>

            <tbody>
                {{-- OÍDO DERECHO --}}
                <tr>
                    <td class="border border-black px-2 py-1 font-semibold">OÍDO DERECHO</td>

                    @foreach ([500,1000,2000,3000,4000,6000,8000] as $hz)
                    <td class="border border-black px-2 py-1">
                        <input type="text"
                            name="fre_oido_der_{{ $hz }}"
                            class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]"
                            value="{{ old('fre_oido_der_'.$hz, $audiometria->{'fre_oido_der_'.$hz} ?? '') }}">
                    </td>
                    @endforeach
                </tr>

                {{-- OÍDO IZQUIERDO --}}
                <tr>
                    <td class="border border-black px-2 py-1 font-semibold">OÍDO IZQUIERDO</td>

                    @foreach ([500,1000,2000,3000,4000,6000,8000] as $hz)
                    <td class="border border-black px-2 py-1">
                        <input type="text"
                            name="fre_oido_izq_{{ $hz }}"
                            class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]"
                            value="{{ old('fre_oido_izq_'.$hz, $audiometria->{'fre_oido_izq_'.$hz} ?? '') }}">
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>

    {{-- RESULTADOS FINALES --}}
    <div class="bg-white rounded-lg border border-gray-400 p-4 mt-6">
        <div class="grid grid-cols-2 gap-4">
            <div class="flex items-center gap-2">
                <label for="perdida_audio_der" class="font-medium whitespace-nowrap">
                    % Pérdida Audio Derecho:
                </label>
                <input type="text"
                    name="perdida_audio_der"
                    id="perdida_audio_der"
                    class="w-full border border-gray-500 p-1 rounded-md focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                    value="{{ old('perdida_audio_der', $audiometria->perdida_audio_der ?? '') }}">
            </div>

            <div class="flex items-center gap-2">
                <label for="perdida_audio_izq" class="font-medium whitespace-nowrap">
                    % Pérdida Audio Izquierdo:
                </label>
                <input type="text"
                    name="perdida_audio_izq"
                    id="perdida_audio_izq"
                    class="w-full border border-gray-500 p-1 rounded-md focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                    value="{{ old('perdida_audio_izq', $audiometria->perdida_audio_izq ?? '') }}">
            </div>
        </div>
    </div>


    <div class="mt-6 flex justify-end">
        <button type="submit"
            class="bg-[#9C1C2A] text-white px-6 py-2 rounded shadow hover:bg-[#7d1621] transition">
            Guardar Evaluación
        </button>
    </div>
</form>

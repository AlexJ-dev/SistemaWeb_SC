

<form action="{{ route('evaluaciones.oftalmologia.store', $evaluacion->id) }}" method="POST">

    @csrf
    <div class="flex flex-col lg:flex-row gap-4">
        <div class="lg:w-1/2 p-4 border border-gray-300 rounded">
            {{-- ANTECEDENTES --}}

            <div class="overflow-x-auto mt-4">
                <table class="table-auto w-full text-center border border-black">

                    <!-- TÍTULO -->
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-black px-2 py-2 text-left font-bold">ANTECEDENTES PATOLOGICOS</th>
                            <th class="border border-black w-16 font-bold">SI</th>
                            <th class="border border-black w-16 font-bold">NO</th>
                        </tr>
                    </thead>

                    <tbody>

                        <!-- ANTECEDENTES -->
                        @foreach ([
                        'HTA' => 'hta',
                        'Diabetes Mellitus' => 'diabetes_mellitus',
                        'Glaucoma' => 'glaucoma',
                        'Estrabismo' => 'estrabismo',
                        'Conjuntivitis' => 'conjuntivitis',
                        'Traumatismo' => 'traumatismo',
                        'Radiaciones' => 'radiaciones',
                        'Químicos' => 'quimicos',
                        'Exposición a computadoras' => 'exposicion_computadoras'
                        ] as $label => $field)
                        <tr>
                            <td class="border border-black px-2 py-2 text-left">{{ $label }}</td>

                            <!-- SI -->
                            <td class="border border-black align-middle">
                                <input type="radio"
                                    name="{{ $field }}"
                                    value="1"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ old($field, $oftalmologia->$field ?? false) == 1 ? 'checked' : '' }}>
                            </td>

                            <!-- NO -->
                            <td class="border border-black align-middle">
                                <input type="radio"
                                    name="{{ $field }}"
                                    value="0"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ old($field, $oftalmologia->$field ?? false) == 0 ? 'checked' : '' }}>
                            </td>
                        </tr>
                        @endforeach

                        <!-- SEPARADOR -->
                        <tr class="bg-gray-200">
                            <td colspan="3" class="border border-black"></td>
                        </tr>

                        <!-- SÍNTOMAS -->
                        @foreach ([
                        'Prurito' => 'prurito',
                        'Visión borrosa' => 'vision_borrosa',
                        'Cefalea' => 'cefalea'
                        ] as $label => $field)
                        <tr>
                            <td class="border border-black px-2 py-2 text-left">{{ $label }}</td>

                            <!-- SI -->
                            <td class="border border-black align-middle">
                                <input type="radio"
                                    name="{{ $field }}"
                                    value="1"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ old($field, $oftalmologia->$field ?? false) == 1 ? 'checked' : '' }}>
                            </td>

                            <!-- NO -->
                            <td class="border border-black align-middle">
                                <input type="radio"
                                    name="{{ $field }}"
                                    value="0"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ old($field, $oftalmologia->$field ?? false) == 0 ? 'checked' : '' }}>
                            </td>
                        </tr>
                        @endforeach

                        <!-- FILA OTROS -->
                        <tr>
                            <td class="border border-black px-2 py-2 text-left font-semibold">Otros</td>
                            <td colspan="2" class="border border-black p-2">
                                <textarea name="otros"
                                    class="w-full border rounded p-2 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">{{ old('otros', $oftalmologia->otros ?? '') }}</textarea>
                            </td>
                        </tr>

                        <!-- SEPARADOR -->
                        <tr class="bg-gray-200">
                            <td colspan="3" class="border border-black"></td>
                        </tr>

                        <!-- EXAMEN FISICO -->
                        <tr>
                            <td class="border border-black px-2 py-2 text-left">¿Usa lentes?</td>

                            <!-- SI -->
                            <td class="border border-black align-middle">
                                <input type="radio"
                                    name="lentes"
                                    value="1"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ old('lentes', $oftalmologia->lentes ?? false) == 1 ? 'checked' : '' }}>
                            </td>

                            <!-- NO -->
                            <td class="border border-black align-middle">
                                <input type="radio"
                                    name="lentes"
                                    value="0"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ old('lentes', $oftalmologia->lentes ?? false) == 0 ? 'checked' : '' }}>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>



        </div>
        <div class="lg:w-1/2 p-4 border border-gray-300 rounded">

            <div class="overflow-x-auto my-6">
                <table class="table-auto w-full text-center border border-black">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-black px-2 py-2 text-left font-bold">EXÁMEN</th>
                            <th class="border border-black w-20 font-bold">Normal</th>
                            <th class="border border-black w-20 font-bold">Anormal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach([
                        'parpados_anexos' => 'Párpados y anexos',
                        'polo_anterior' => 'Polo anterior',
                        'reflejo_pupilar' => 'Reflejo pupilar',
                        ] as $field => $label)
                        <tr>
                            <td class="border border-black px-2 py-2 text-left">{{ $label }}</td>

                            <!-- Normal -->
                            <td class="border border-black align-middle">
                                <input type="radio"
                                    name="{{ $field }}"
                                    value="1"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ old($field, $oftalmologia->$field ?? null) == 1 ? 'checked' : '' }}>
                            </td>

                            <!-- Anormal -->
                            <td class="border border-black align-middle">
                                <input type="radio"
                                    name="{{ $field }}"
                                    value="0"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ old($field, $oftalmologia->$field ?? null) == 0 ? 'checked' : '' }}>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="grid grid-cols-[auto_1fr] gap-x-4 gap-y-2 items-center mb-6">

                <!-- Campos tipo input (Normal / texto) -->
                @foreach([
                'test_ishihara' => 'Test de Ishihara',
                'vision_nocturna' => 'Visión nocturna',
                'vision_profundidad' => 'Visión de profundidad',
                ] as $field => $label)

                <label>{{ $label }} :</label>
                <input type="text"
                    name="{{ $field }}"
                    class="w-full border border-gray-500 p-1 rounded-md focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                    value="{{ old($field, $oftalmologia->$field ?? '') }}">
                @endforeach

                <!-- Visión de colores (Radios Normal / Anormal) -->
                <label>Visión de colores :</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2">
                        <input type="radio"
                            name="vision_colores"
                            value="1"
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                            {{ old('vision_colores', $oftalmologia->vision_colores ?? null) == 1 ? 'checked' : '' }}>
                        Normal
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="radio"
                            name="vision_colores"
                            value="0"
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                            {{ old('vision_colores', $oftalmologia->vision_colores ?? null) == 0 ? 'checked' : '' }}>
                        Anormal
                    </label>
                </div>

            </div>

            <!-- SIN CORRECTOR -->
            <div class="mb-4">
                <div>
                    <h4 class="font-semibold mb-2 text-center">AGUDEZA VISUAL</h4>
                </div>
                <h4 class="font-semibold mb-2">SIN CORRECTOR</h4>

                <table class="table-auto w-full text-center border border-black">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-black px-2 py-1 font-bold w-1/3">Visión</th>
                            <th class="border border-black px-2 py-1 font-bold">OD</th>
                            <th class="border border-black px-2 py-1 font-bold">OI</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- LEJOS -->
                        <tr>
                            <td class="border border-black px-2 py-1">Lejos</td>

                            <!-- OD = Ojo Derecho -->
                            <td class="border border-black px-2 py-1">
                                <input type="text"
                                    name="av_lejos_sin_corrector_der"
                                    value="{{ old('av_lejos_sin_corrector_der', $oftalmologia->av_lejos_sin_corrector_der ?? '') }}"
                                    class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                            </td>

                            <!-- OI = Ojo Izquierdo -->
                            <td class="border border-black px-2 py-1">
                                <input type="text"
                                    name="av_lejos_sin_corrector_izq"
                                    value="{{ old('av_lejos_sin_corrector_izq', $oftalmologia->av_lejos_sin_corrector_izq ?? '') }}"
                                    class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                            </td>
                        </tr>

                        <!-- CERCA -->
                        <tr>
                            <td class="border border-black px-2 py-1">Cerca</td>

                            <td class="border border-black px-2 py-1">
                                <input type="text"
                                    name="av_cerca_sin_corrector_der"
                                    value="{{ old('av_cerca_sin_corrector_der', $oftalmologia->av_cerca_sin_corrector_der ?? '') }}"
                                    class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                            </td>

                            <td class="border border-black px-2 py-1">
                                <input type="text"
                                    name="av_cerca_sin_corrector_izq"
                                    value="{{ old('av_cerca_sin_corrector_izq', $oftalmologia->av_cerca_sin_corrector_izq ?? '') }}"
                                    class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <!-- CON CORRECTOR -->
            <div>
                <h4 class="font-semibold mb-2">CON CORRECTOR</h4>

                <table class="table-auto w-full text-center border border-black">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-black px-2 py-1 font-bold w-1/3">Visión</th>
                            <th class="border border-black px-2 py-1 font-bold">OD</th>
                            <th class="border border-black px-2 py-1 font-bold">OI</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- LEJOS -->
                        <tr>
                            <td class="border border-black px-2 py-1">Lejos</td>

                            <td class="border border-black px-2 py-1">
                                <input type="text"
                                    name="av_lejos_con_corrector_der"
                                    value="{{ old('av_lejos_con_corrector_der', $oftalmologia->av_lejos_con_corrector_der ?? '') }}"
                                    class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                            </td>

                            <td class="border border-black px-2 py-1">
                                <input type="text"
                                    name="av_lejos_con_corrector_izq"
                                    value="{{ old('av_lejos_con_corrector_izq', $oftalmologia->av_lejos_con_corrector_izq ?? '') }}"
                                    class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                            </td>
                        </tr>

                        <!-- CERCA -->
                        <tr>
                            <td class="border border-black px-2 py-1">Cerca</td>

                            <td class="border border-black px-2 py-1">
                                <input type="text"
                                    name="av_cerca_con_corrector_der"
                                    value="{{ old('av_cerca_con_corrector_der', $oftalmologia->av_cerca_con_corrector_der ?? '') }}"
                                    class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                            </td>

                            <td class="border border-black px-2 py-1">
                                <input type="text"
                                    name="av_cerca_con_corrector_izq"
                                    value="{{ old('av_cerca_con_corrector_izq', $oftalmologia->av_cerca_con_corrector_izq ?? '') }}"
                                    class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>


            <div class="flex items-center space-x-4 mt-6">
                <label for="sensibilidad_mucosa" class="w-60">Sensibilidad mucosa :</label>
                <input type="text"
                    name="sensibilidad_mucosa"
                    class="w-full border border-gray-500 p-1 rounded-md focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                    value="{{ old('sensibilidad_mucosa', $oftalmologia->sensibilidad_mucosa ?? '') }}">
            </div>

        </div>
    </div>
    <div class="p-4 border border-gray-300 rounded">
        {{-- DIAGNÓSTICO Y RECOMENDACIONES --}}

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="text-sm font-medium text-gray-700">Diagnóstico</label>
                <textarea name="diagnostico"
                    class="w-full border rounded p-2 mt-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">{{ old('diagnostico', $oftalmologia->diagnostico ?? '') }}</textarea>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Recomendaciones</label>
                <textarea name="recomendaciones"
                    class="w-full border rounded p-2 mt-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">{{ old('recomendaciones', $oftalmologia->recomendaciones ?? '') }}</textarea>
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

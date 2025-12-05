

<form action="{{ route('evaluaciones.espirometria.store', $evaluacion->id) }}" method="POST">

    @csrf

    <div class="overflow-x-auto">
        <table class="table-auto w-full text-center border border-black">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-black w-12 px-2 py-2 font-bold">N°</th>
                    <th class="border border-black px-2 py-2 text-left font-bold">A. Criterios de exclusión</th>
                    <th class="border border-black w-16 font-bold">SI</th>
                    <th class="border border-black w-16 font-bold">NO</th>
                </tr>
            </thead>

            <tbody>
                @php
                $antecedentes = [
                'deprendimiento_retina' => '¿Tuvo desprendimiento de retina en los últimos 3 meses?',
                'infarto_corazon' => '¿Ha tenido infarto al corazón en los últimos 3 meses?',
                'hopitalizado_problema_corazon' => '¿Ha estado hospitalizado por algún problema del corazón durante los 3 últimos meses?',
                'medicamentos_tuberculosis' => '¿Está usando medicamentos para la tuberculosis en este momento?',
                'embarazo_actual' => 'En caso de ser Mujer, ¿Está embarazada actualmente?',
                'diagnostico_covid' => '¿En las últimas 3 semanas tuvo un diagnostico positivo a COVID-19?',

                'SECCION_HOSPITAL' => '---',

                'hemoptisis' => 'Hemoptisis',
                'pneumotrorax' => 'Pneumotórax',
                'traqueostomia' => 'Traqueostomía',
                'sonda_pleurral' => 'Sonda pleural',
                'aneurisma_celebral_abdomen_torax' => 'Aneurisma cerebral, Abdomen, Tórax',
                'embolia_pulmonar' => 'Embolia pulmonar',
                'infarto_reciente' => 'Infarto reciente',
                'inestabilidad_cv' => 'Inestabilidad CV',
                'fiebre_nauseas_vomitos' => 'Fiebre, Náuseas, Vómitos',
                'embarazo_avanzado' => 'Embarazo avanzado',
                'embarazo_complicado' => 'Embarazo complicado',
                'amenaza_aborto' => 'Amenaza de aborto',
                ];

                $num = 1;
                @endphp

                @foreach ($antecedentes as $field => $label)
                @if ($field === 'SECCION_HOSPITAL')
                <!-- Fila separadora -->
                <tr class="bg-gray-200 font-bold">
                    <th class="border border-black w-12 px-2 py-2 font-bold"></th>
                    <th class="border border-black px-2 py-2 text-left font-bold">Enfermedad en el hospital</th>
                    <th class="border border-black w-16 font-bold"></th>
                    <th class="border border-black w-16 font-bold"></th>
                </tr>
                @else
                @php $value = old($field, $espirometria->$field ?? null); @endphp

                <tr>
                    <td class="border border-black px-2 py-2 text-center">{{ $num++ }}</td>
                    <td class="border border-black px-2 py-2 text-left">{{ $label }}</td>

                    <!-- SI -->
                    <td class="border border-black align-middle">
                        <input
                            type="radio"
                            name="{{ $field }}"
                            value="1"
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                            {{ $value == 1 ? 'checked' : '' }}>
                    </td>

                    <!-- NO -->
                    <td class="border border-black align-middle">
                        <input
                            type="radio"
                            name="{{ $field }}"
                            value="0"
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                            {{ $value == 0 ? 'checked' : '' }}>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>

        </table>
    </div>


    <div class="overflow-x-auto">
        <table class="table-auto w-full text-center border border-black">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-black w-12 font-bold">N°</th>
                    <th class="border border-black text-left font-bold">B. Entrevistado que no tiene criterios de exclusión</th>
                    <th class="border border-black w-16 font-bold">SI</th>
                    <th class="border border-black w-16 font-bold">NO</th>
                </tr>
            </thead>

            <tbody>
                @php
                $habitos = [
                'infeccion_respiratoria' => '¿Tuvo una infección respiratoria en las últimas 3 semanas?',
                'infeccion_oido' => '¿Tuvo alguna infección en el oído en la última semana?',
                'nebulizadores_broncodilatadores' => '¿Utilizó nebulizadores con broncodilatadores en las últimas 3 horas?',
                'medicamento_broncodilatador' => '¿Ha utilizado algún medicamento broncodilatador en las últimas 8 horas?',
                'fumo_cigarrillos' => '¿Fumó cigarrillo en las últimas 2 horas? ¿Cuántos?',
                'ejercicio_fisico' => '¿Realizó algún ejercicio físico fuerte (gimnasia o trote) en la última hora?',
                'comio' => '¿Cómió en la última hora?'
                ];
                $num2 = 1;
                @endphp

                @foreach ($habitos as $field => $label)
                @php
                $value = old($field, $espirometria->$field ?? null);
                @endphp

                <tr>
                    <td class="border border-black text-center">{{ $num2 }}</td>

                    <td class="border border-black text-left px-2 py-2">

                        {{-- CONTENIDO GENERAL --}}
                        @if ($field === 'fumo_cigarrillos')
                        <div class="flex items-center gap-4">

                            {{-- Texto de la pregunta --}}
                            <span>{{ $label }}</span>

                            {{-- Input al costado derecho --}}
                            <div class="flex items-center gap-2">
                                <input
                                    type="number"
                                    name="cuantos_cigarrillos"
                                    class="w-20 border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]" min="0"
                                    value="{{ old('cuantos_cigarrillos', $espirometria->cuantos_cigarrillos ?? '') }}">
                            </div>

                        </div>
                        @else
                        {{-- FILAS NORMALES --}}
                        {{ $label }}
                        @endif

                    </td>


                    {{-- SI --}}
                    <td class="border border-black align-middle">
                        <input type="radio" name="{{ $field }}" value="1"
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                            {{ $value == 1 ? 'checked' : '' }}>
                    </td>

                    {{-- NO --}}
                    <td class="border border-black align-middle">
                        <input type="radio" name="{{ $field }}" value="0"
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                            {{ $value == 0 ? 'checked' : '' }}>
                    </td>
                </tr>

                @php $num2++; @endphp

                @endforeach

            </tbody>

        </table>
    </div>

    {{-- ESPECIFICACIONES --}}
    <div>
        <label class="text-lg font-semibold text-gray-700">C. De haber marcado "Sí" en la encuesta B, especifique:</label>
        <textarea
            name="especificaciones"
            class="w-full border rounded p-2 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">{{ old('especificaciones', $espirometria->especificaciones ?? '') }}</textarea>
    </div>

    {{-- RESULTADOS --}}
    <h3 class="text-lg font-semibold text-gray-700">D. Análisis de los datos</h3>

    <div class="overflow-x-auto">


        <div class="max-w-2xl mx-auto">
            <table class="table-auto w-full text-center border border-black">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-black px-3 py-2 font-bold w-2/6">PARÁMETRO</th>
                        <th class="border border-black px-3 py-2 font-bold w-1/6">PRE</th>
                        <th class="border border-black px-3 py-2 font-bold w-1/6">% REF</th>
                        <th class="border border-black px-3 py-2 font-bold w-1/6">REF</th>
                    </tr>
                </thead>

                <tbody>

                    {{-- FVC --}}
                    <tr>
                        <td class="border border-black px-3 py-2">FVC</td>

                        <td class="border border-black px-3 py-2">
                            <input type="text" name="fvc_pre"
                                value="{{ old('fvc_pre', $espirometria->fvc_pre ?? '') }}"
                                class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                        </td>

                        <td class="border border-black px-3 py-2">
                            <input type="text" name="fvc_ref_porcentaje"
                                value="{{ old('fvc_ref_porcentaje', $espirometria->fvc_ref_porcentaje ?? '') }}"
                                class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                        </td>

                        <td class="border border-black px-3 py-2">
                            <input type="text" name="fvc_ref"
                                value="{{ old('fvc_ref', $espirometria->fvc_ref ?? '') }}"
                                class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                        </td>
                    </tr>

                    {{-- FEV1 --}}
                    <tr>
                        <td class="border border-black px-3 py-2">FEV1</td>

                        <td class="border border-black px-3 py-2">
                            <input type="text" name="fev1_pre"
                                value="{{ old('fev1_pre', $espirometria->fev1_pre ?? '') }}"
                                class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                        </td>

                        <td class="border border-black px-3 py-2">
                            <input type="text" name="fev1_ref_porcentaje"
                                value="{{ old('fev1_ref_porcentaje', $espirometria->fev1_ref_porcentaje ?? '') }}"
                                class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                        </td>

                        <td class="border border-black px-3 py-2">
                            <input type="text" name="fev1_ref"
                                value="{{ old('fev1_ref', $espirometria->fev1_ref ?? '') }}"
                                class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                        </td>
                    </tr>

                    {{-- FEV/FVC --}}
                    <tr>
                        <td class="border border-black px-3 py-2">FEV/FVC</td>

                        <td class="border border-black px-3 py-2">
                            <input type="text" name="fev_fvc_pre"
                                value="{{ old('fev_fvc_pre', $espirometria->fev_fvc_pre ?? '') }}"
                                class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                        </td>

                        <td class="border border-black px-3 py-2">
                            <input type="text" name="fev_fvc_ref_porcentaje"
                                value="{{ old('fev_fvc_ref_porcentaje', $espirometria->fev_fvc_ref_porcentaje ?? '') }}"
                                class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                        </td>

                        <td class="border border-black px-3 py-2">
                            <input type="text" name="fev_fvc_ref"
                                value="{{ old('fev_fvc_ref', $espirometria->fev_fvc_ref ?? '') }}"
                                class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                        </td>
                    </tr>

                    {{-- FEF --}}
                    <tr>
                        <td class="border border-black px-3 py-2">FEF 25-75%</td>

                        <td class="border border-black px-3 py-2">
                            <input type="text" name="fef_pre"
                                value="{{ old('fef_pre', $espirometria->fef_pre ?? '') }}"
                                class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                        </td>

                        <td class="border border-black px-3 py-2">
                            <input type="text" name="fef_ref_porcentaje"
                                value="{{ old('fef_ref_porcentaje', $espirometria->fef_ref_porcentaje ?? '') }}"
                                class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                        </td>

                        <td class="border border-black px-3 py-2">
                            <input type="text" name="fef_ref"
                                value="{{ old('fef_ref', $espirometria->fef_ref ?? '') }}"
                                class="w-full border-none text-center focus:outline-none focus:ring-[#9C1C2A]">
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-6 flex justify-end">
        <button type="submit"
            class="bg-[#9C1C2A] text-white px-6 py-2 rounded shadow hover:bg-[#7d1621] transition">
            Guardar Evaluación
        </button>
    </div>

</form>

<div class="space-y-6">

    {{-- Antecedentes Patológicos Personales --}}
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-[#4C4C4C] mb-4">Antecedentes Patológicos Personales</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @foreach ($enfermedades as $enfermedad)
            <label class="flex items-center space-x-2">
                <input
                    type="checkbox"
                    name="antecedentes_medicos[enfermedades][]"
                    value="{{ $enfermedad->id }}"
                    @checked(
                    (isset($antecedentesMedicos) &&
                    $antecedentesMedicos->enfermedades->contains($enfermedad->id)) ||
                (is_array(old('antecedentes_medicos.enfermedades')) &&
                in_array($enfermedad->id, old('antecedentes_medicos.enfermedades')))
                )
                class="rounded border-gray-300 text-[#9C1C2A] focus:ring-[#9C1C2A]"
                >
                <span class="text-sm text-[#4C4C4C]">{{ $enfermedad->nombre }}</span>
            </label>
            @endforeach
        </div>
    </div>

    {{-- Procedimientos y Condiciones (campos dinámicos con JSON) --}}
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-[#4C4C4C] mb-4">Procedimientos y Condiciones</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Cirugías --}}
            <div>
                <label class="block font-semibold text-[#4C4C4C] mb-1">Cirugías</label>
                <div id="cirugias-container">
                    @php
                    $cirugias = old('antecedentes_medicos.cirugias', $antecedentesMedicos->cirugias ?? ['']);
                    @endphp
                    @foreach ($cirugias as $item)
                    <div class="flex items-center">
                        <x-input-clinico
                            label=""
                            name="antecedentes_medicos[cirugias][]"
                            value="{{ $item }}"
                            class="w-full" />
                        <button type="button" class="ml-1 text-red-500 remove-field">✖</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="text-sm text-[#4C4C4C] add-field" data-target="cirugias-container">+ Añadir otra</button>
            </div>

            {{-- Intoxicaciones --}}
            <div>
                <label class="block font-semibold text-[#4C4C4C] mb-1">Intoxicaciones</label>
                <div id="intoxicaciones-container">
                    @php
                    $intoxicaciones = old('antecedentes_medicos.intoxicaciones', $antecedentesMedicos->intoxicaciones ?? ['']);
                    @endphp
                    @foreach ($intoxicaciones as $item)
                    <div class="flex items-center">
                        <x-input-clinico
                            label=""
                            name="antecedentes_medicos[intoxicaciones][]"
                            value="{{ $item }}"
                            class="w-full" />
                        <button type="button" class="ml-1 text-red-500 remove-field">✖</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="text-sm text-[#4C4C4C] add-field" data-target="intoxicaciones-container">+ Añadir otra</button>
            </div>

            {{-- Alergias --}}
            <div>
                <label class="block font-semibold text-[#4C4C4C] mb-1">Alergias</label>
                <div id="alergias-container">
                    @php
                    $alergias = old('antecedentes_medicos.alergias', $antecedentesMedicos->alergias ?? ['']);
                    @endphp
                    @foreach ($alergias as $item)
                    <div class="flex items-center">
                        <x-input-clinico
                            label=""
                            name="antecedentes_medicos[alergias][]"
                            value="{{ $item }}"
                            class="w-full" />
                        <button type="button" class="ml-1 text-red-500 remove-field">✖</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="text-sm text-[#4C4C4C] add-field" data-target="alergias-container">+ Añadir otra</button>
            </div>

            {{-- Hospitalizaciones --}}
            <div>
                <label class="block font-semibold text-[#4C4C4C] mb-1">Hospitalizaciones</label>
                <div id="hospitalizaciones-container">
                    @php
                    $hospitalizaciones = old('antecedentes_medicos.hospitalizaciones', $antecedentesMedicos->hospitalizaciones ?? ['']);
                    @endphp
                    @foreach ($hospitalizaciones as $item)
                    <div class="flex items-center">
                        <x-input-clinico
                            label=""
                            name="antecedentes_medicos[hospitalizaciones][]"
                            value="{{ $item }}"
                            class="w-full" />
                        <button type="button" class="ml-1 text-red-500 remove-field">✖</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="text-sm text-[#4C4C4C] add-field" data-target="hospitalizaciones-container">+ Añadir otra</button>
            </div>

            {{-- Medicamentos actuales --}}
            <div>
                <label class="block font-semibold text-[#4C4C4C] mb-1">Medicamentos actuales</label>
                <div id="medicamentos-container">
                    @php
                    $medicamentos = old('antecedentes_medicos.medicamentos', $antecedentesMedicos->medicamentos ?? ['']);
                    @endphp
                    @foreach ($medicamentos as $item)
                    <div class="flex items-center ">
                        <x-input-clinico
                            label=""
                            name="antecedentes_medicos[medicamentos][]"
                            value="{{ $item }}"
                            class="w-full" />
                        <button type="button" class="ml-1 text-red-500 remove-field">✖</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="text-sm text-[#4C4C4C] add-field" data-target="medicamentos-container">+ Añadir otra</button>
            </div>

            {{-- Inmunizaciones --}}
            <div>
                <label class="block font-semibold text-[#4C4C4C] mb-1">Inmunizaciones</label>
                <div id="inmunizaciones-container">
                    @php
                    $inmunizaciones = old('antecedentes_medicos.inmunizaciones', $antecedentesMedicos->inmunizaciones ?? ['']);
                    @endphp
                    @foreach ($inmunizaciones as $item)
                    <div class="flex items-center">
                        <x-input-clinico
                            label=""
                            name="antecedentes_medicos[inmunizaciones][]"
                            value="{{ $item }}"
                            class="w-full" />
                        <button type="button" class="ml-1 text-red-500 remove-field">✖</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="text-sm text-[#4C4C4C] add-field" data-target="inmunizaciones-container">+ Añadir otra</button>
            </div>
        </div>

        <div class="mt-4">
            <x-input-clinico label="Observaciones" name="antecedentes_medicos[observaciones]"
                value="{{ old('antecedentes_medicos.observaciones', $antecedentesMedicos->observaciones ?? '') }}" />
        </div>
    </div>

    {{-- Hábitos y Grupo Sanguíneo --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Hábitos --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-[#4C4C4C] mb-4">Hábitos</h3>

            <table class="w-full text-sm text-left border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-[#4C4C4C]">
                    <tr>
                        <th class="p-2">Hábito</th>
                        <th class="p-2 text-center">Nada</th>
                        <th class="p-2 text-center">Poco</th>
                        <th class="p-2 text-center">Habitual</th>
                        <th class="p-2 text-center">Excesivo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (['tabaco' => 'Tabaco', 'alcohol' => 'Alcohol', 'drogas' => 'Drogas'] as $habito => $label)
                    <tr class="border-t border-gray-300">
                        <td class="p-2">{{ $label }}</td>
                        @foreach (['nada', 'poco', 'habitual', 'excesivo'] as $nivel)
                        <td class="text-center p-2">
                            <input type="radio"
                                name="antecedentes_medicos[habito_{{ $habito }}]"
                                value="{{ $nivel }}"
                                @checked(old("antecedentes_medicos.habito_$habito", $antecedentesMedicos?->{"habito_$habito"}) === $nivel)
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]">
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Grupo Sanguíneo --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-[#4C4C4C] mb-4">Grupo Sanguíneo</h3>

            <div class="space-y-4">
                {{-- Grupo --}}
                <div>
                    <label class="block font-semibold text-[#4C4C4C] mb-2">Tipo</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach (['A', 'B', 'AB', 'O'] as $grupo)
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="grupo" value="{{ $grupo }}"
                                @checked(old('grupo', isset($antecedentesMedicos) && str_contains($antecedentesMedicos->grupo_sanguineo ?? '', $grupo)))
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]">
                            <span>{{ $grupo }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Factor RH --}}
                <div>
                    <label class="block font-semibold text-[#4C4C4C] mb-2">Factor RH</label>
                    <div class="flex gap-4">
                        @foreach (['+' => 'Positivo', '-' => 'Negativo'] as $valor => $texto)
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="rh" value="{{ $valor }}"
                                @checked(old('rh', isset($antecedentesMedicos) && str_ends_with($antecedentesMedicos->grupo_sanguineo ?? '', $valor)))
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]">
                            <span>{{ $texto }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Campo oculto que guarda el valor final --}}
                <input type="hidden" name="antecedentes_medicos[grupo_sanguineo]" id="grupo_sanguineo"
                    value="{{ old('antecedentes_medicos.grupo_sanguineo', $antecedentesMedicos->grupo_sanguineo ?? '') }}">
            </div>
        </div>
    </div>

</div>
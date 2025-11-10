{{-- ANTECEDENTES FAMILIARES --}}

{{-- Número de hijos --}}
<div class="rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-[#4C4C4C] mb-4">Número de hijos</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <x-input-clinico
                label="Vivos"
                type="number"
                name="antecedentes_familiares[numero_hijos_vivos]"
                value="{{ old('antecedentes_familiares.numero_hijos_vivos', $antecedentesFamiliares->numero_hijos_vivos ?? '') }}"
                min="0" />
        </div>
        <div>
            <x-input-clinico
                label="Fallecidos"
                type="number"
                name="antecedentes_familiares[numero_hijos_muertos]"
                value="{{ old('antecedentes_familiares.numero_hijos_muertos', $antecedentesFamiliares->numero_hijos_muertos ?? '') }}" 
                min="0"/>
        </div>
</div>
    
    </div>


    {{-- Situación de salud --}}
    <div class="mt-10 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-[#4C4C4C] mb-4">Situación de salud</h3>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100 text-sm text-gray-700 uppercase">
                    <tr>
                        <th class="py-2 px-4 text-left">Parentesco</th>
                        <th class="py-2 px-4 text-left">Estado</th>
                        <th class="py-2 px-4 text-left">Observaciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">

                    <tr>
                        <td class="py-3 px-4 font-medium text-gray-700">Padre</td>
                        <td class="py-3 px-4">
                            <x-input-clinico
                                label=""
                                name="antecedentes_familiares[salud_padre]"
                                value="{{ old('antecedentes_familiares.salud_padre', $antecedentesFamiliares->salud_padre ?? '') }}" />
                        </td>
                        <td class="py-3 px-4">
                            <x-input-clinico
                                label=""
                                name="antecedentes_familiares[observacion_padre]"
                                value="{{ old('antecedentes_familiares.observacion_padre', $antecedentesFamiliares->observacion_padre ?? '') }}" />
                        </td>
                    </tr>

                    <tr>
                        <td class="py-3 px-4 font-medium text-gray-700">Madre</td>
                        <td class="py-3 px-4">
                            <x-input-clinico
                                label=""
                                name="antecedentes_familiares[salud_madre]"
                                value="{{ old('antecedentes_familiares.salud_madre', $antecedentesFamiliares->salud_madre ?? '') }}" />
                        </td>
                        <td class="py-3 px-4">
                            <x-input-clinico
                                label=""
                                name="antecedentes_familiares[observacion_madre]"
                                value="{{ old('antecedentes_familiares.observacion_madre', $antecedentesFamiliares->observacion_madre ?? '') }}" />
                        </td>
                    </tr>

                    <tr>
                        <td class="py-3 px-4 font-medium text-gray-700">Esposo(a)</td>
                        <td class="py-3 px-4">
                            <x-input-clinico
                                label=""
                                name="antecedentes_familiares[salud_esposo]"
                                value="{{ old('antecedentes_familiares.salud_esposo', $antecedentesFamiliares->salud_esposo ?? '') }}" />
                        </td>
                        <td class="py-3 px-4">
                            <x-input-clinico
                                label=""
                                name="antecedentes_familiares[observacion_esposo]"
                                value="{{ old('antecedentes_familiares.observacion_esposo', $antecedentesFamiliares->observacion_esposo ?? '') }}" />
                        </td>
                    </tr>

                    <tr>
                        <td class="py-3 px-4 font-medium text-gray-700">Hijos</td>
                        <td class="py-3 px-4">
                            <x-input-clinico
                                label=""
                                name="antecedentes_familiares[salud_hijos]"
                                value="{{ old('antecedentes_familiares.salud_hijos', $antecedentesFamiliares->salud_hijos ?? '') }}" />
                        </td>
                        <td class="py-3 px-4">
                            <x-input-clinico
                                label=""
                                name="antecedentes_familiares[observacion_hijos]"
                                value="{{ old('antecedentes_familiares.observacion_hijos', $antecedentesFamiliares->observacion_hijos ?? '') }}" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Número de dependientes --}}
    <div class="mt-10 flex items-center space-x-4 rounded-lg shadow p-6">
        <label class="text-lg font-semibold text-[#4C4C4C]">N° Dependientes</label>
        <div class="w-32">
            <x-input-clinico
                label=""
                type="number"
                name="antecedentes_familiares[numero_dependientes]"
                value="{{ old('antecedentes_familiares.numero_dependientes', $antecedentesFamiliares->numero_dependientes ?? '') }}" 
                min="0"/>
        </div>
    </div>

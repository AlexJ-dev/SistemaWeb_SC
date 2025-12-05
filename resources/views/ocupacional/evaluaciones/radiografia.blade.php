<form action="{{ route('evaluaciones.radiografia.store', $evaluacion->id) }}" method="POST"
    class="max-w-4xl mx-auto bg-white p-4 rounded-lg shadow-lg">
    @csrf
    {{-- EXAMEN DE TÓRAX A-P --}}
    <div class="p-4 border border-gray-300 rounded">
        <h2 class="text-xl font-bold text-red-800 mb-6">EXAMEN DE TÓRAX A-P</h2>
        <h3 class="text-lg font-semibold mb-4">La radiografía de tórax en la incidencia postero anterior muestra</h3>

        <div class="space-y-3">

            {{-- Campos pulmonares --}}
            <div class="flex items-center space-x-2">
                <label class="w-60">Campos Pulmonares:</label>
                <input type="text" name="campos_pulmonares"
                    value="{{ old('campos_pulmonares', is_array($radiografia->campos_pulmonares ?? null)
                        ? implode(', ', $radiografia->campos_pulmonares)
                        : ($radiografia->campos_pulmonares ?? '')
                    ) }}"
                    class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
            </div>

            {{-- Senos --}}
            <div class="flex items-center space-x-2">
                <label class="w-60">Senos:</label>
                <input type="text" name="senos"
                    value="{{ old('senos', is_array($radiografia->senos ?? null)
                        ? implode(', ', $radiografia->senos)
                        : ($radiografia->senos ?? '')
                    ) }}"
                    class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
            </div>

            {{-- Silueta cardiovascular --}}
            <div class="flex items-center space-x-2">
                <label class="w-60">Silueta Cardiovascular:</label>
                <input type="text" name="silueta_cardiovascular"
                    value="{{ old('silueta_cardiovascular', is_array($radiografia->silueta_cardiovascular ?? null)
                        ? implode(', ', $radiografia->silueta_cardiovascular)
                        : ($radiografia->silueta_cardiovascular ?? '')
                    ) }}"
                    class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
            </div>


            <!-- FALTA CONCLUCION -->

        </div>
    </div>



    {{-- SECCIÓN HALLAZGOS ÚNICOS Y DATOS TÉCNICOS --}}
    <div class="p-4 border border-gray-300 rounded">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">

            {{-- IZQUIERDA --}}
            <div class="space-y-4">

                <div class="flex items-center space-x-2">
                    <label class="w-32">Vértices:</label>
                    <input type="text" name="vertices"
                        value="{{ old('vertices', $radiografia->vertices ?? '') }}"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>

                <div class="flex items-center space-x-2">
                    <label class="w-32">Hilo:</label>
                    <input type="text" name="hilo"
                        value="{{ old('hilo', $radiografia->hilo ?? '') }}"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>

                <div class="flex items-center space-x-2">
                    <label class="w-32">Mediastinos:</label>
                    <input type="text" name="mediastinos"
                        value="{{ old('mediastinos', $radiografia->mediastinos ?? '') }}"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>
            </div>

            {{-- DERECHA --}}
            <div class="space-y-4">

                <div class="flex items-center space-x-2">
                    <label class="w-24">N° Rx:</label>
                    <input type="number" name="numero_rayosx"
                        value="{{ old('numero_rayosx', $radiografia->numero_rayosx ?? '') }}"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>

                <div class="flex items-center space-x-2">
                    <label class="w-24">Calidad:</label>
                    <input type="text" name="calidad"
                        value="{{ old('calidad', $radiografia->calidad ?? '') }}"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>

                <div class="flex items-center space-x-2">
                    <label class="w-24">Fecha:</label>
                    <input type="date" name="fecha"
                        value="{{ old('fecha', $radiografia->fecha ?? '') }}"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>

                <div class="flex items-center space-x-2">
                    <label class="w-24">Símbolos:</label>
                    <input type="text" name="simbolos"
                        value="{{ old('simbolos', $radiografia->simbolos ?? '') }}"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>
            </div>
        </div>

        {{-- Evaluación radiológica --}}
        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-4">Evaluación radiológica (Clasificación RX)</h3>

            <div class="overflow-x-auto">
                <table class="table-auto w-full text-center border border-black">
                    <thead>
                        <tr class="text-gray-700 bg-gray-100">
                            <th class="border border-black px-2 py-1">0/0</th>
                            <th class="border border-black px-2 py-1">1/0</th>
                            <th class="border border-black px-2 py-1">1/0</th>
                            <th class="border border-black px-2 py-1">2/1 , 2/2 , 2/3</th>
                            <th class="border border-black px-2 py-1">3/1 , 3/3 , 3/+</th>
                            <th class="border border-black px-2 py-1">A , B , C</th>
                            <th class="border border-black px-2 py-1">St</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="border border-black px-2 py-1">CERO</td>
                            <td class="border border-black px-2 py-1">UNO</td>
                            <td class="border border-black px-2 py-1">UNO</td>
                            <td class="border border-black px-2 py-1">DOS</td>
                            <td class="border border-black px-2 py-1">TRES</td>
                            <td class="border border-black px-2 py-1">CUATRO</td>
                            <td class="border border-black px-2 py-1">CUATRO</td>
                        </tr>

                        @php
                        $clasificacion = old('evaluacion_radiologica', $radiografia->evaluacion_radiologica ?? '');
                        @endphp

                        <tr>
                            <td class="border border-black px-2 py-2">
                                <input type="radio" name="evaluacion_radiologica"
                                    value="0/0"
                                    class="accetext-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ $clasificacion === '0/0' ? 'checked' : '' }}>
                            </td>

                            <td class="border border-black px-2 py-2">
                                <input type="radio" name="evaluacion_radiologica"
                                    value="1/0a"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ $clasificacion === '1/0a' ? 'checked' : '' }}>
                            </td>

                            <td class="border border-black px-2 py-2">
                                <input type="radio" name="evaluacion_radiologica"
                                    value="1/0b"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ $clasificacion === '1/0b' ? 'checked' : '' }}>
                            </td>

                            <td class="border border-black px-2 py-2">
                                <input type="radio" name="evaluacion_radiologica"
                                    value="2"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ $clasificacion === '2' ? 'checked' : '' }}>
                            </td>

                            <td class="border border-black px-2 py-2">
                                <input type="radio" name="evaluacion_radiologica"
                                    value="3"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ $clasificacion === '3' ? 'checked' : '' }}>
                            </td>

                            <td class="border border-black px-2 py-2">
                                <input type="radio" name="evaluacion_radiologica"
                                    value="ABC"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ $clasificacion === 'ABC' ? 'checked' : '' }}>
                            </td>

                            <td class="border border-black px-2 py-2">
                                <input type="radio" name="evaluacion_radiologica"
                                    value="St"
                                    class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                                    {{ $clasificacion === 'St' ? 'checked' : '' }}>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Incidencias frontales y laterales --}}
        <h3 class="text-lg font-semibold mb-4 mt-6">Incidencias frontales y laterales</h3>
        <textarea
            name="incidencias_frontales_laterales"
            class="w-full border rounded p-2 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
            rows="3">{{ old('incidencias_frontales_laterales', is_array($radiografia->incidencias_frontales_laterales ?? null)
        ? implode(', ', $radiografia->incidencias_frontales_laterales)
        : ($radiografia->incidencias_frontales_laterales ?? '')
    ) }}</textarea>

        {{-- Conclusiones --}}
        <h3 class="text-lg font-semibold mb-4 mt-6">Conclusiones</h3>
        <textarea
            name="conclusiones"
            class="w-full border rounded p-2 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
            rows="3">{{ old('conclusiones', is_array($radiografia->conclusiones ?? null)
        ? implode(', ', $radiografia->conclusiones)
        : ($radiografia->conclusiones ?? '')
    ) }}</textarea>


    </div>

    {{-- BOTÓN --}}
    <div class="mt-8 flex justify-end space-x-4">
        {{-- Botón PDF --}}
        <a href="{{ route('radiografia.pdf', $evaluacion->id) }}"
            target="_blank"
            class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-6 rounded shadow-md transition flex items-center space-x-2">
            <span>PDF</span>
        </a>

        <button type="submit"
            class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-6 rounded shadow-md transition flex items-center space-x-2">
            <span>Guardar</span>
        </button>
    </div>

</form>
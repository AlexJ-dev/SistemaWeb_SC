<x-clinico-layout>
    <x-encabezado-clinico />

    <div class="mt-8 px-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-[#4C4C4C] mb-6">
                Nueva Ficha Médica Ocupacional
            </h2>

            <form action="{{ route('ocupacional.fichas.guardar') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Datos ocultos --}}
                <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                <input type="hidden" name="historia_clinica_id" value="{{ $historiaClinica?->id }}">
                <input type="hidden" name="ruta_medica_id" value="{{ $rutaMedica?->id }}">

                {{-- Datos del paciente --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input-clinico label="Apellidos y Nombres" name="nombre_completo"
                        value="{{ $paciente->apellidos }}, {{ $paciente->nombres }}" disabled />

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-input-clinico label="Documento" name="documento" value="{{ $paciente->documento }}" disabled />
                        <x-input-clinico label="Número de Historia Clínica" name="numero_historia"
                            value="{{ $historiaClinica?->numero_historia ?? 'No registrada' }}" disabled />
                    </div>
                </div>

                {{-- Tipo de Evaluación --}}
                <div>
                    <label class="block text-sm font-medium text-[#4C4C4C] mb-2">Tipo de Evaluación</label>
                    <div class="flex flex-wrap gap-4">
                        @php
                        $tipoActual = $rutaMedica?->tipo_evaluacion ?? '';
                        @endphp

                        @foreach (['inicio' => 'Inicio', 'periodico' => 'Periódico', 'retiro' => 'Retiro'] as $valor => $texto)
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="tipo_evaluacion" value="{{ $valor }}"
                                @checked(strtolower($tipoActual)===$valor)
                                class="text-[#9C1C2A] focus:ring-[#9C1C2A]">
                            <span class="text-[#4C4C4C]">{{ $texto }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Empresa / Contratista --}}
                <div class="flex flex-col space-y-4">

                    {{-- EMPRESA --}}
                    <div class="flex gap-2 items-center ">
                        <x-input-clinico label="Empresa" name="empresa" id="empresa"
                            :value="$rutaMedica?->empresa" />

                        <button type="button"
                            onclick="abrirModalEmpresa('empresa')"
                            class="px-3 h-[42px] bg-gray-300 text-[#4C4C4C] rounded hover:bg-gray-400 transition shadow mt-1">
                            Buscar
                        </button>
                    </div>

                    {{-- CONTRATISTA --}}
                    <div class="flex gap-2 items-center">
                        <x-input-clinico label="Contratista" name="contratista" id="contratista" />

                        <button type="button"
                            onclick="abrirModalEmpresa('contratista')"
                            class="px-3 h-[42px] bg-gray-300 text-[#4C4C4C] rounded hover:bg-gray-400 transition shadow mt-1">
                            Buscar
                        </button>
                    </div>


                </div>


                {{-- Puestos y tiempo --}}
                <div class="flex flex-col space-y-4">
                    <x-input-clinico label="Puesto al que Postula" name="puesto_postula" />
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-input-clinico label="Puesto Actual" name="puesto_actual" />
                        <x-input-clinico label="Tiempo en Puesto Actual" name="tiempo_puesto_actual" />
                    </div>
                </div>

                {{-- Exploración / Procesados --}}
                <div>
                    <label class="block text-sm font-medium text-[#4C4C4C] mb-2">Exploración / Procesados</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach (['superficie' => 'Superficie', 'concentradora' => 'Concentradora', 'subsuelo' => 'Subsuelo'] as $valor => $texto)
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="exploracion_procesados" value="{{ $valor }}"
                                class="text-[#9C1C2A] focus:ring-[#9C1C2A]">
                            <span class="text-[#4C4C4C]">{{ $texto }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Altitud --}}
                <div>
                    <label class="block text-sm font-medium text-[#4C4C4C] mb-2">Altitud</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach ([
                        'debajo_2500' => 'Debajo de 2500 m',
                        '2501_3000' => '2501 a 3000 m',
                        '3001_3500' => '3001 a 3500 m',
                        '3501_4000' => '3501 a 4000 m',
                        '4001_4500' => '4001 a 4500 m',
                        'mas_4501' => 'Más de 4501 m',
                        ] as $valor => $texto)
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="altitud" value="{{ $valor }}"
                                class="text-[#9C1C2A] focus:ring-[#9C1C2A]">
                            <span class="text-[#4C4C4C]">{{ $texto }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @php
                $from = request('from');
                @endphp

                {{-- Botones --}}
                <div class="flex justify-end space-x-4 mt-6">
                    <a href="{{ $from === 'inicio' ? route('inicio') : route('evaluaciones') }}"
                        class="px-4 py-2 bg-gray-300 text-[#4C4C4C] rounded hover:bg-gray-400 transition">
                        Salir
                    </a>

                    <button type="submit"
                        class="px-4 py-2 bg-[#9C1C2A] text-white rounded hover:bg-[#b91c1c] transition">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-clinico-layout>
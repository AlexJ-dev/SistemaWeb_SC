<x-clinico-layout>
    <x-encabezado-clinico />

    <div class="mt-8 px-6">
        <h2 class="text-2xl font-bold text-[#4C4C4C] mb-4">Historia Clínica</h2>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <div class="flex space-x-4">
                    <button
                        type="button"
                        class="tab-button text-lg font-semibold text-[#9C1C2A] border-b-4 border-transparent px-3 py-2 rounded-t-md 
                   hover:text-[#7C1A24] hover:border-[#9C1C2A] hover:bg-[#FCEBEB] transition-all duration-200"
                        data-tab="historia">
                        Historia Clínica
                    </button>

                    <button
                        type="button"
                        class="tab-button text-lg font-semibold text-[#9C1C2A] border-b-4 border-transparent px-3 py-2 rounded-t-md 
                   hover:text-[#7C1A24] hover:border-[#9C1C2A] hover:bg-[#FCEBEB] transition-all duration-200"
                        data-tab="medicos">
                        Antecedentes Médicos
                    </button>

                    <button
                        type="button"
                        class="tab-button text-lg font-semibold text-[#9C1C2A] border-b-4 border-transparent px-3 py-2 rounded-t-md 
                   hover:text-[#7C1A24] hover:border-[#9C1C2A] hover:bg-[#FCEBEB] transition-all duration-200"
                        data-tab="familiares">
                        Antecedentes Familiares
                    </button>
                </div>

                <div class="mt-2 md:mt-0 w-48">
                    <x-input-clinico
                        label="N° de Historia"
                        name="historia[numero_historia]"
                        :value="old('historia.numero_historia', $historia->numero_historia)"
                        readonly />
                </div>
            </div>
            @php
            $from = request()->query('from'); // lee el ?from=inicio o ?from=pacientes
            @endphp
            <form method="POST" action="{{ route('historiaClinica.actualizar', $paciente->documento) }}">
                @csrf

                <div id="tab-historia" class="tab-content">
                    @include('ocupacional.historia.partials.historia-clinica')
                </div>

                <div id="tab-medicos" class="tab-content hidden">
                    @include('ocupacional.historia.partials.antecedentes-medicos')
                </div>

                <div id="tab-familiares" class="tab-content hidden">
                    @include('ocupacional.historia.partials.antecedentes-familiares')
                </div>

                <div class="mt-6 flex justify-end space-x-4">
                    <button type="submit" class="bg-[#9C1C2A] text-white px-6 py-2 rounded shadow hover:bg-[#7C1A24]">
                        Guardar todo
                    </button>

                    <!-- Botón cancelar dinámico -->
                    <a href="{{ $from === 'inicio' ? route('inicio') : route('pacientes') }}"
                        class="bg-gray-400 text-white px-6 py-2 rounded shadow hover:bg-gray-500">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
                document.getElementById('tab-' + btn.dataset.tab).classList.remove('hidden');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab-button');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Quitar clase activa de todos
                    tabs.forEach(t => t.classList.remove(
                        'border-[#9C1C2A]',
                        'text-[#7C1A24]',
                        'bg-[#FCEBEB]'
                    ));

                    // Agregar clase activa al seleccionado
                    this.classList.add(
                        'border-[#9C1C2A]',
                        'text-[#7C1A24]',
                        'bg-[#FCEBEB]'
                    );
                });
            });

            // Marcar el primero como activo por defecto
            tabs[0].classList.add('border-[#9C1C2A]', 'text-[#7C1A24]', 'bg-[#FCEBEB]');
        });
    </script>
</x-clinico-layout>
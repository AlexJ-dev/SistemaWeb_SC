<x-clinico-layout>
    <x-encabezado-clinico />

    <div class="bg-white shadow rounded p-6">

        <h2 class="text-xl font-semibold mb-4">Editar historial ocupacional</h2>

        <form action="{{ route('historia.update', $historial->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label class="font-semibold">Fecha inicio</label>
                    <input type="date" name="fecha_inicio"
                        value="{{ $historial->fecha_inicio }}"
                        class="w-full border rounded focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>

                <div>
                    <label class="font-semibold">Fecha fin</label>
                    <input type="date" name="fecha_fin"
                        value="{{ $historial->fecha_fin }}"
                        class="w-full border rounded focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>

                <div>
                    <label class="font-semibold">Empresa</label>
                    <input type="text" name="empresa"
                        value="{{ $historial->empresa }}"
                        class="w-full border rounded focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>

                <div>
                    <label class="font-semibold">Ocupación</label>
                    <input type="text" name="ocupacion"
                        value="{{ $historial->ocupacion }}"
                        class="w-full border rounded focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>

                <div class="col-span-2">
                    <label class="font-semibold">Actividad realizada</label>
                    <input type="text" name="actividad_realizada"
                        value="{{ $historial->actividad_realizada }}"
                        class="w-full border rounded focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>

                <div class="col-span-2">
                    <label class="font-semibold">Área de trabajo</label>
                    <input type="text" name="area_trabajo"
                        value="{{ $historial->area_trabajo }}"
                        class="w-full border rounded focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>

                <div>
                    <label class="font-semibold">Ubicación Departamento</label>
                    <input type="text" name="ubicacion_departamento"
                        value="{{ $historial->ubicacion_departamento }}"
                        class="w-full border rounded focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>

                <div>
                    <label class="font-semibold">Altura S.N.M</label>
                    <input type="number" name="altura_snm"
                        value="{{ $historial->altura_snm }}"
                        class="w-full border rounded focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>

                <div>
                    <label class="font-semibold">Tiempo Subsuelo</label>
                    <input type="number" name="tiempo_subsuelo"
                        value="{{ $historial->tiempo_subsuelo }}"
                        class="w-full border rounded focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>

                <div>
                    <label class="font-semibold">Tiempo Superficie</label>
                    <input type="number" name="tiempo_superficie"
                        value="{{ $historial->tiempo_superficie }}"
                        class="w-full border rounded focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                </div>

                <div class="col-span-2">
                    <label class="font-semibold">Exposiciones peligrosas</label>
                    <textarea name="exposiciones_peligrosas"
                        class="w-full border rounded p-2 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">{{ $historial->exposiciones_peligrosas }}</textarea>
                </div>

                <div class="col-span-2">
                    <label class="font-semibold">Medidas de protección ambiental</label>
                    <textarea name="medidas_proteccion_ambiental"
                        class="w-full border rounded p-2 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">{{ $historial->medidas_proteccion_ambiental }}</textarea>
                </div>

                <div class="col-span-2">
                    <label class="font-semibold">Medidas de protección personal</label>
                    <textarea name="medidas_proteccion_personal"
                        class="w-full border rounded p-2 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">{{ $historial->medidas_proteccion_personal }}</textarea>
                </div>

            </div>

            <!--campos ocultos-->
            <input type="hidden" name="from" value="{{ request('from') }}">
            <input type="hidden" name="ficha" value="{{ request('ficha') }}">


            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('historia.index', [
                        'paciente_id' => $paciente->id,
                        'from' => request('from'),
                        'ficha' => request('ficha')
                    ]) }}" class="px-4 py-2 bg-gray-300 text-[#4C4C4C] rounded hover:bg-gray-400 transition">
                    Salir
                </a>

                <button class="px-4 py-2 bg-[#9C1C2A] text-white rounded hover:bg-[#b91c1c] transition">
                    Guardar
                </button>
            </div>

        </form>

    </div>
</x-clinico-layout>
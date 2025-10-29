<x-clinico-layout>
    <x-encabezado-clinico />

    <div class="mt-8 px-6">
        <p class="text-lg text-[#4C4C4C] mt-2">Registrar nueva área ocupacional</p>

        {{-- Formulario de registro --}}
        <form method="POST" action="{{ route('areas.store') }}" class="bg-white rounded-lg shadow p-4 space-y-4 mt-4">
            @csrf
            <x-input-clinico label="Nombre del área" name="nombre" />
            <x-input-clinico label="Ubicación física" name="ubicacion" />
            <x-textarea-clinico label="Descripción general:" name="descripcion" />
            <div class="flex justify-end">
                <x-boton-clinico>Guardar área</x-boton-clinico>
            </div>
        </form>

        {{-- Tabla de áreas registradas --}}
        <div class="mt-6 bg-white rounded-lg shadow p-6">
            <table class="w-full table-auto border-collapse">
                <thead class="bg-[#9C1C2A] text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">Nombre</th>
                        <th class="px-4 py-2 text-center">Ubicación</th>
                        <th class="px-4 py-2 text-center">Descripción</th>
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($areas as $area)
                    <tr class="text-[#4C4C4C]">
                        <form method="POST" action="{{ route('areas.update', $area) }}">
                            @csrf @method('PUT')
                            <td class="px-2 py-2">
                                <input type="text" name="nombre" value="{{ $area->nombre }}" class="w-full border rounded px-2 py-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                            </td>
                            <td class="px-2 py-2">
                                <input type="text" name="ubicacion" value="{{ $area->ubicacion }}" class="w-full border rounded px-2 py-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                            </td>
                            <td class="px-2 py-2">
                                <textarea name="descripcion" rows="1" class="w-full border rounded px-2 py-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A] resize-none h-[38px]">{{ $area->descripcion }}</textarea>
                            </td>

                            <td class="px-2 py-2 text-center flex gap-2 justify-center">
                                <button type="submit" class="text-[#9C1C2A] underline">Actualizar</button>
                        </form>
                        <form method="POST" action="{{ route('areas.destroy', $area) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-[#4C4C4C] underline">Eliminar</button>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-clinico-layout>
<x-clinico-layout>
    <x-encabezado-clinico />
    <div class="mt-8 px-6">
        <p class="text-lg text-[#4C4C4C] mt-2">
            Registrar nueva especialidad clinica
        </p>
        <form method="POST" action="{{ route('ocupacional.mantenimiento.especialidades.store') }}" class="bg-white rounded-lg shadow p-4 space-y-4 mb-4 mt-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input-clinico label="Nombre" name="nombre" />
                <x-input-clinico label="Descripción" name="descripcion" />
            </div>
            <div class="flex justify-end space-x-4 pt-2">
                <x-boton-clinico>Guardar</x-boton-clinico>
            </div>
        </form>

        <div class="mt-4 bg-white rounded-lg shadow p-6">
            <table class="w-full table-auto border-collapse">
                <thead class="bg-[#9C1C2A] text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">Nombre</th>
                        <th class="px-4 py-2 text-center">Descripción</th>
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($especialidades as $esp)
                    <tr class="text-[#4C4C4C]">
                        <form method="POST" action="{{ route('ocupacional.mantenimiento.especialidades.update', $esp) }}">
                            @csrf @method('PUT')
                            <td class="px-1 py-2">
                                <input type="text" name="nombre" style="text-transform: uppercase;" value="{{ $esp->nombre }}" class = "block w-full rounded border-gray-300 shadow-sm focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                            </td>
                            <td class="px-1 py-2">
                                <input type="text" name="descripcion" style="text-transform: uppercase;" value="{{ $esp->descripcion }}"  class = "block w-full rounded border-gray-300 shadow-sm focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"">
                            </td>
                            <td class="px-1s py-2 text-center flex justify-center gap-4">
                                <button type="submit" class="text-[#9C1C2A] underline">Actualizar</button>
                        </form>
                        <form method="POST" action="{{ route('ocupacional.mantenimiento.especialidades.destroy', $esp) }}">
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
<x-clinico-layout>
    @include('ocupacional.mantenimiento.partials.modal-registro')
    @include('ocupacional.mantenimiento.partials.modal-editar')
    <x-encabezado-clinico />
    <div class="mt-8 px-6">
        <p class="text-lg text-[#4C4C4C] mt-2">
            Registrar nuevo personal
        </p>
    </div>

    {{-- Botón para abrir el modal de registro --}}
    <div class="flex justify-end px-6 mt-8">
        <button onclick="document.getElementById('modal-registro').showModal()" class="bg-[#9C1C2A] text-white px-4 py-2 rounded shadow hover:bg-[#7F1924]">
            Nuevo personal
        </button>


    </div>

    {{-- Tabla única con separaciones por rol --}}
    <div class="mt-4 px-6">
        <div class="bg-white rounded-lg shadow p-6">
            <table class="w-full table-auto border-collapse">
                <thead class="bg-[#9C1C2A] text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">Apellidos</th>
                        <th class="px-4 py-2 text-center">Nombres</th>
                        <th class="px-4 py-2 text-center">Sexo</th>
                        <th class="px-4 py-2 text-center">DNI</th>
                        <th class="px-4 py-2 text-center">Teléfono</th>
                        <th class="px-4 py-2 text-center">Especialidad</th>
                        <th class="px-4 py-2 text-center">Rol</th>
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                    <tr>
                        <td colspan="8" class="bg-gray-100 text-[#9C1C2A] font-semibold px-4 py-2">
                            {{ $rol->nombre }}
                        </td>
                    </tr>
                    @foreach ($personal->where('rol_id', $rol->id) as $p)
                    <tr class="text-[#4C4C4C]">
                        <td class="px-4 py-2 text-center">{{ $p->apellido }}</td>
                        <td class="px-4 py-2 text-center">{{ $p->nombre }}</td>
                        <td class="px-4 py-2 text-center">{{ $p->sexo }}</td>
                        <td class="px-4 py-2 text-center">{{ $p->dni }}</td>
                        <td class="px-4 py-2 text-center">{{ $p->telefono }}</td>
                        <td class="px-4 py-2 text-center">{{ $p->especialidad->nombre ?? '-' }}</td>
                        <td class="px-4 py-2 text-center">{{ $p->rol->nombre }}</td>
                        <td class="px-4 py-2 text-center flex justify-center gap-4">
                            <button
                                data-id="{{ $p->id }}"
                                class="text-[#9C1C2A] underline btn-editar"
                                onclick="document.getElementById('modal-editar-{{ $p->id }}').showModal()">
                                Editar
                            </button>

                            <form method="POST" action="{{ route('ocupacional.mantenimiento.personal.destroy', $p) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-[#4C4C4C] underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endforeach

                    @if ($personal->whereNull('rol_id')->count() > 0)
                    <tr>
                        <td colspan="8" class="bg-gray-100 text-[#9C1C2A] font-semibold px-4 py-2">
                            Sin rol
                        </td>
                    </tr>
                    @foreach ($personal->whereNull('rol_id') as $p)
                    <tr class="text-[#4C4C4C]">
                        <td class="px-4 py-2 text-center">{{ $p->apellido }}</td>
                        <td class="px-4 py-2 text-center">{{ $p->nombre }}</td>
                        <td class="px-4 py-2 text-center">{{ $p->sexo }}</td>
                        <td class="px-4 py-2 text-center">{{ $p->dni }}</td>
                        <td class="px-4 py-2 text-center">{{ $p->telefono }}</td>
                        <td class="px-4 py-2 text-center">{{ $p->especialidad->nombre ?? '-' }}</td>
                        <td class="px-4 py-2 text-center">-</td>
                        <td class="px-4 py-2 text-center flex justify-center gap-4">
                            <button
                                data-id="{{ $p->id }}"
                                class="text-[#9C1C2A] underline btn-editar"
                                onclick="document.getElementById('modal-editar-{{ $p->id }}').showModal()">
                                Editar
                            </button>

                            <form method="POST" action="{{ route('ocupacional.mantenimiento.personal.destroy', $p) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-[#4C4C4C] underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-clinico-layout>

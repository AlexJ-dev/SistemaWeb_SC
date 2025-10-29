<x-clinico-layout>
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
                        <th class="px-4 py-2 text-center">Apellido</th>
                        <th class="px-4 py-2 text-center">Nombre</th>
                        <th class="px-4 py-2 text-center">Sexo</th>
                        <th class="px-4 py-2 text-center">DNI</th>
                        <th class="px-4 py-2 text-center">Teléfono</th>
                        <th class="px-4 py-2 text-center">Especialidad</th>
                        <th class="px-4 py-2 text-center">Rol</th>
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Agrupación por rol --}}
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
                            <button onclick="document.getElementById('modal-editar-{{ $p->id }}').showModal()" class="text-[#9C1C2A] underline">Editar</button>
                            <form method="POST" action="{{ route('ocupacional.mantenimiento.personal.destroy', $p) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-[#4C4C4C] underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endforeach

                    {{-- Personal sin rol --}}
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
                            <button onclick="document.getElementById('modal-editar-{{ $p->id }}').showModal()" class="text-[#9C1C2A] underline">Editar</button>
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

    {{-- Modales de edición (fuera de la tabla) --}}
    @foreach ($personal as $p)
    <x-modal-clinico
        id="modal-editar-{{ $p->id }}"
        titulo="Editar personal"
        accion="{{ route('ocupacional.mantenimiento.personal.update', $p) }}"
        metodo="PUT"
        boton="Actualizar">
        <x-input-clinico label="Apellido" name="apellido" :value="$p->apellido" />
        <x-input-clinico label="Nombre" name="nombre" :value="$p->nombre" />
        <x-select-clinico name="sexo" label="Sexo">
            <option value="M" {{ $p->sexo === 'M' ? 'selected' : '' }}>Masculino</option>
            <option value="F" {{ $p->sexo === 'F' ? 'selected' : '' }}>Femenino</option>
        </x-select-clinico>
        <x-input-clinico label="DNI" name="dni" :value="$p->dni" />
        <x-input-clinico label="Teléfono" name="telefono" :value="$p->telefono" />
        <x-input-clinico label="Dirección" name="direccion" :value="$p->direccion" />
        <x-input-clinico label="Fecha de nacimiento" name="fecha_nacimiento" type="date" :value="$p->fecha_nacimiento" />
        <x-input-clinico label="Edad" name="edad" type="number" :value="$p->edad" />
        <x-input-clinico label="CMP" name="cmp" :value="$p->cmp" />
        <x-select-clinico name="especialidad_id" label="Especialidad">
            <option value="">-- Ninguna --</option>
            @foreach ($especialidades as $esp)
            <option value="{{ $esp->id }}" {{ $p->especialidad_id == $esp->id ? 'selected' : '' }}>
                {{ $esp->nombre }}
            </option>
            @endforeach
        </x-select-clinico>
        <x-select-clinico name="rol_id" label="Rol institucional">
            <option value="">-- Sin rol --</option>
            @foreach ($roles as $r)
            <option value="{{ $r->id }}" {{ $p->rol_id == $r->id ? 'selected' : '' }}>
                {{ $r->nombre }}
            </option>
            @endforeach
        </x-select-clinico>
    </x-modal-clinico>
    @endforeach

    {{-- Modal de registro --}}
    <x-modal-clinico
        id="modal-registro"
        titulo="Registrar nuevo personal"
        accion="{{ route('ocupacional.mantenimiento.personal.store') }}">

        <x-input-clinico label="Apellido" name="apellido" />
        <x-input-clinico label="Nombre" name="nombre" />

        <x-select-clinico name="sexo" label="Sexo">
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </x-select-clinico>

        <x-input-clinico label="DNI" name="dni" />
        <x-input-clinico label="Teléfono" name="telefono" />
        <x-input-clinico label="Dirección" name="direccion" />
        <x-input-clinico label="Fecha de nacimiento" name="fecha_nacimiento" type="date" />
        <x-input-clinico label="Edad" name="edad" type="number" />
        <x-input-clinico label="CMP" name="cmp" />

        <x-select-clinico name="especialidad_id" label="Especialidad">
            <option value="">-- Ninguna --</option>
            @foreach ($especialidades as $esp)
            <option value="{{ $esp->id }}">{{ $esp->nombre }}</option>
            @endforeach
        </x-select-clinico>

        <x-select-clinico name="rol_id" label="Rol institucional">
            <option value="">-- Sin rol --</option>
            @foreach ($roles as $rol)
            <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
            @endforeach
        </x-select-clinico>

    </x-modal-clinico>

</x-clinico-layout>
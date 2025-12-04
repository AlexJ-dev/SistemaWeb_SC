<x-clinico-layout>
    <x-encabezado-clinico />

    <div class="mt-8 px-6">
        <p class="text-lg text-[#4C4C4C] mt-2">
            Registrar nuevo usuario del sistema
        </p>

        <form id="form-usuario" method="POST" action="{{ route('ocupacional.mantenimiento.usuarios.store') }}"
            class="bg-white rounded-lg shadow p-4 space-y-4 mb-4 mt-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nombre de usuario -->
                <div class="relative">
                    <x-input-clinico label="Nombre de usuario" name="name" id="name" value="" />
                    <p id="name-error" class="absolute text-red-500 text-sm -top-0 left-36 hidden"></p>
                </div>

                <!-- Contraseña -->
                <div class="relative">
                    <x-input-clinico label="Contraseña" name="password" id="password" type="text" value="" maxlength="6" />
                    <p id="password-error" class="absolute text-red-500 text-sm -top-0 left-24 hidden"></p>
                </div>

                <x-select-clinico name="personal_id" label="Personal asociado" id="personal_id">
                    <option value="">-- Seleccionar --</option>
                    @foreach ($personal as $p)
                    <option value="{{ $p->id }}">{{ $p->apellido }}, {{ $p->nombre }}</option>
                    @endforeach
                </x-select-clinico>
            </div>
            <div class="flex justify-end space-x-4 pt-2">
                <button type="button" id="cancelar-btn"
                    class="px-4 py-2 rounded bg-gray-300 text-[#4C4C4C] hover:bg-gray-400">Cancelar</button>
                <x-boton-clinico>Guardar</x-boton-clinico>
            </div>
        </form>


        {{-- Tabla de usuarios --}}
        <div class="mt-4 bg-white rounded-lg shadow p-6">
            <table class="w-full table-auto border-collapse">
                <thead class="bg-[#9C1C2A] text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">Usuario</th>
                        <th class="px-4 py-2 text-center">Contraseña</th>
                        <th class="px-4 py-2 text-center">Rol clínico</th>
                        <th class="px-4 py-2 text-center">Personal</th>
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $u)
                    <tr class="text-[#4C4C4C]">
                        <form method="POST" action="{{ route('ocupacional.mantenimiento.usuarios.update', $u) }}">
                            @csrf @method('PUT')
                            <td class="px-1 py-2">
                                <input type="text" name="name" value="{{ $u->name }}" class="block w-full rounded border-gray-300 shadow-sm focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                            </td>
                            <td class="px-1 py-2 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <span class="text-sm">{{ $u->password_visible ?? '••••••' }}</span>
                                    @if($u->password_visible)
                                    <button type="button" onclick="copiarCredenciales('{{ $u->name }}', '{{ $u->password_visible }}')" class=" bg-white hover:bg-[#F5F5F5]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#9C1C2A]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="3" width="13" height="13" rx="2" ry="2" />
                                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2" />
                                        </svg>
                                    </button>
                                    @endif
                                </div>
                            </td>

                            <td class="px-1 py-2 text-center">
                                {{ $u->personal->rol->nombre ?? 'Sin rol' }}
                            </td>
                            <td class="px-1 py-2">
                                <select name="personal_id" class="block w-full rounded border-gray-300 shadow-sm focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">
                                    @foreach ($personal as $p)
                                    <option value="{{ $p->id }}" {{ $u->personal_id == $p->id ? 'selected' : '' }}>
                                        {{ $p->apellido }}, {{ $p->nombre }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-1 py-2 text-center flex justify-center gap-4">
                                <button type="submit" class="text-[#9C1C2A] underline">Actualizar</button>
                        </form>
                        <form method="POST" action="{{ route('ocupacional.mantenimiento.usuarios.destroy', $u) }}">
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
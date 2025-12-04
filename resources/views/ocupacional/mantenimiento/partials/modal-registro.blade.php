{{-- Modal de registro --}}
<x-modal-clinico
    id="modal-registro"
    titulo="Registrar nuevo personal"
    accion="{{ route('ocupacional.mantenimiento.personal.store') }}">

    <x-input-clinico label="Apellidos" name="apellido" required />
    <x-input-clinico label="Nombres" name="nombre" required />

    <x-select-clinico name="sexo" label="Sexo" required>
        <option value="M">Masculino</option>
        <option value="F">Femenino</option>
    </x-select-clinico>
    <div class="relative">
        <x-input-clinico label="DNI" name="dni" required maxlength="8" id="dni" />
        <p id="dni-error" class="absolute -top-0 left-6 text-xs text-red-600 bg-white px-3 hidden">
        </p>

    </div>
    <div class="relative">
        <x-input-clinico label="Teléfono" name="telefono" id="telefono" required maxlength="20" />
        <p id="telefono-error" class="absolute -top-0 left-6 text-xs text-red-600 bg-white px-3 hidden"></p>
    </div>
    <x-input-clinico label="Dirección" name="direccion" required />
    <x-input-clinico label="Fecha de nacimiento" name="fecha_nacimiento" type="date" />
    <x-input-clinico label="Edad" name="edad" type="number" />
    <x-select-clinico name="rol_id" label="Rol institucional" id="rol_id" required>
        <option value="">-- Sin rol --</option>
        @foreach ($roles as $rol)
        <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
        @endforeach
    </x-select-clinico>
    <div class="col-span-2">
        <p class="text-sm text-gray-600">
            <strong>Nota:</strong> Los campos CMP y Especialidad sólo son obligatorios si el rol seleccionado es
            "Médico".
        </p>
    </div>
    <x-input-clinico label="CMP" name="cmp" id="cmp" maxlength="10" />

    <x-select-clinico name="especialidad_id" label="Especialidad" id="especialidad_id">
        <option value="">-- Ninguna --</option>
        @foreach ($especialidades as $esp)
        <option value="{{ $esp->id }}">{{ $esp->nombre }}</option>
        @endforeach
    </x-select-clinico>
</x-modal-clinico>
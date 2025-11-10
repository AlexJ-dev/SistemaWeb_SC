@foreach ($personal as $p)
<x-modal-clinico
    id="modal-editar-{{ $p->id }}"
    titulo="Editar personal"
    accion="{{ route('ocupacional.mantenimiento.personal.update', $p->id) }}"
    metodo="PUT">

    <x-input-clinico label="Apellidos" name="apellido" value="{{ $p->apellido }}" required />
    <x-input-clinico label="Nombres" name="nombre" value="{{ $p->nombre }}" required />

    <x-select-clinico name="sexo" label="Sexo" required>
        <option value="M" {{ $p->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
        <option value="F" {{ $p->sexo == 'F' ? 'selected' : '' }}>Femenino</option>
    </x-select-clinico>

    <div class="relative">
        <x-input-clinico label="DNI" name="dni" required maxlength="8" value="{{ $p->dni }}" />
        <p id="dni-edit-error" class="absolute -top-0 left-6 text-xs text-red-600 bg-white px-3 hidden">
        </p>
    </div>

    <x-input-clinico label="Teléfono" name="telefono" required maxlength="9" value="{{ $p->telefono }}" />
    <x-input-clinico label="Dirección" name="direccion" value="{{ $p->direccion }}" required />
    <x-input-clinico label="Fecha de nacimiento" name="fecha_nacimiento" type="date" value="{{ $p->fecha_nacimiento }}" />
    <x-input-clinico label="Edad" name="edad" type="number" value="{{ $p->edad }}" />

    <x-select-clinico name="rol_id" label="Rol institucional" id="rol_id-{{ $p->id }}" required>
        <option value="">-- Sin rol --</option>
        @foreach ($roles as $rol)
        <option value="{{ $rol->id }}" {{ $p->rol_id == $rol->id ? 'selected' : '' }}>
            {{ $rol->nombre }}
        </option>
        @endforeach
    </x-select-clinico>


    <div class="col-span-2">
        <p class="text-sm text-gray-600">
            <strong>Nota:</strong> Los campos CMP y Especialidad sólo son obligatorios si el rol seleccionado es "Médico".
        </p>
    </div>

    <x-input-clinico label="CMP" name="cmp" id="cmp-{{ $p->id }}" value="{{ $p->cmp }}" />

    <x-select-clinico name="especialidad_id" label="Especialidad" id="especialidad_id-{{ $p->id }}">
        <option value="">-- Ninguna --</option>
        @foreach ($especialidades as $esp)
        <option value="{{ $esp->id }}" {{ $p->especialidad_id == $esp->id ? 'selected' : '' }}>
            {{ $esp->nombre }}
        </option>
        @endforeach
    </x-select-clinico>
</x-modal-clinico>
@endforeach
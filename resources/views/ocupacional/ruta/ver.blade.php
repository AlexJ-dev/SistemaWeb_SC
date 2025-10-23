<x-clinico-layout>
    <x-encabezado-clinico />

    <div class="mt-8 px-6">
        <h2 class="text-2xl font-bold text-[#4C4C4C] mb-4">Hoja de Ruta Médica</h2>

        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <p><strong>DNI:</strong> {{ $ruta->documento }}</p>
            <p><strong>Nombre:</strong> {{ $ruta->nombres }} {{ $ruta->apellidos }}</p>
            <p><strong>Empresa:</strong> {{ $ruta->empresa }}</p>
            <p><strong>Cargo:</strong> {{ $ruta->cargo }}</p>
            <p><strong>Tipo de Evaluación:</strong> {{ $ruta->tipo_evaluacion }}</p>
            <p><strong>Registrado por:</strong> {{ $ruta->registrado_por }}</p>
            <p><strong>Fecha de Registro:</strong> {{ $ruta->registrado_en->format('d/m/Y H:i') }}</p>
        </div>
    </div>
</x-clinico-layout>
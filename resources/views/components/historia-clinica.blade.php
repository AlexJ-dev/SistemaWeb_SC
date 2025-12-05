<div class="mb-6">
    <h3 class="text-xl font-semibold">Historia Clínica</h3>

    @if($historia)
        <form method="POST" action="{{ route('historiaClinica.actualizar', $paciente->documento) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="block">Número de Historia</label>
                <input type="text" name="numero_historia"
                       value="{{ $historia->numero_historia }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="block">Diagnóstico</label>
                <textarea name="diagnostico" class="form-control">{{ $historia->diagnostico }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    @else
        <p class="text-gray-500 italic">No se encontró historia clínica.</p>
    @endif
</div>

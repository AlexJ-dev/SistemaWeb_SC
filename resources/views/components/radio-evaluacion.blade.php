@props([
    'label' => 'Tipo de Evaluación',
    'name' => 'tipo_evaluacion',
    'options' => [
        'inicio' => 'Inicio',
        'periodico' => 'Periódico',
        'retiro' => 'Retiro'
    ]
])

<div class="pt-4">
    <label class="block text-sm font-medium text-[#4C4C4C] mb-2">{{ $label }}:</label>
    <div class="flex flex-col md:flex-row gap-4">
        @foreach ($options as $value => $text)
            <label class="inline-flex items-center">
                <input type="radio" name="{{ $name }}" value="{{ $value }}" class="text-[#9C1C2A] focus:ring-[#9C1C2A]" />
                <span class="ml-2 text-[#4C4C4C]">{{ $text }}</span>
            </label>
        @endforeach
    </div>
</div>

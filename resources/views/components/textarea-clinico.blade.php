@props([
'label' => '',
'name',
'value' => '',
])

<div class="flex flex-col space-y-1">
    @if($label)
    <label for="{{ $name }}" class="text-sm text-[#4C4C4C] font-semibold">{{ $label }}</label>
    @endif
    <textarea
    name="descripcion"
    id="descripcion"
    rows="1"
    class="w-full h-[38px] rounded border-gray-300 px-2 py-1 shadow-sm focus:outline-none focus:ring-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A] resize-none"
>{{ old('descripcion', $area->descripcion ?? '') }}</textarea>


</div>
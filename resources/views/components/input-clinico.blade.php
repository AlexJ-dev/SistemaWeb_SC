@props(['label', 'name', 'type' => 'text'])

<div>
    <label class="block text-sm font-medium text-[#4C4C4C]">{{ $label }}:</label>
    <input type="{{ $type }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-[#9C1C2A] focus:border-[#9C1C2A]']) }} />
</div>

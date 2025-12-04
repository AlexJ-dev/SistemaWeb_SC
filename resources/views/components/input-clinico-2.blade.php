@props(['label', 'name', 'type' => 'text'])

<div class="w-full mb-4 flex items-center">
    <label class="text-sm font-medium text-[#4C4C4C] w-1/4">{{ $label }}</label>
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        {{ $attributes->merge([
            'class' => 'ml-2 block w-3/4 rounded border-gray-300 shadow-sm focus:ring-[#9C1C2A] focus:border-[#9C1C2A]'
        ]) }} 
    />
</div>

@props(['label', 'name', 'type' => 'text', 'suffix' => ''])

<div class="w-full mb-2">
    <div class="grid grid-cols-12 items-center gap-2">

        <!-- LABEL (3 columnas) -->
        <label class="col-span-4 text-sm font-medium text-[#4C4C4C]">
            {{ $label }}
        </label>

        <!-- INPUT (7 columnas) -->
        <div class="col-span-6 flex items-center">
            <input 
                type="{{ $type }}" 
                name="{{ $name }}"
                {{ $attributes->merge([
                    'class' => 'block w-full rounded border-gray-300 shadow-sm 
                                focus:ring-[#9C1C2A] focus:border-[#9C1C2A]'
                ]) }}
            />
        </div>

        <!-- SUFFIX (2 columnas) -->
        <span class="col-span-2 text-sm text-gray-600">
            {{ $suffix }}
        </span>
    </div>
</div>

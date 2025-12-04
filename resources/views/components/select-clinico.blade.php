@props(['label', 'name', 'options' => null, 'value' => null])

<div class="w-full mb-4">
    <label class="block text-sm font-medium text-[#4C4C4C]">{{ $label }}:</label>
    <select name="{{ $name }}" {{ $attributes->merge(['class' => 'mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-[#9C1C2A] focus:border-[#9C1C2A]']) }}>
        @if ($options)
            @foreach ($options as $optionValue => $text)
                <option value="{{ $optionValue }}" {{ $optionValue == $value ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endforeach
        @else
            {{ $slot }}
        @endif
    </select>
</div>

@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-[#4C4C4C]']) }}>
    {{ $value ?? $slot }}
</label>

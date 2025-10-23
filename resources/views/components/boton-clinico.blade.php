@props(['type' => 'submit', 'color' => 'primary'])

@php
    $base = 'px-4 py-2 rounded transition';
    $colors = [
        'primary' => 'bg-[#9C1C2A] text-white hover:bg-[#b91c1c]',
        'secondary' => 'bg-gray-300 text-[#4C4C4C] hover:bg-gray-400',
    ];
@endphp

<button type="{{ $type }}" class="{{ $base }} {{ $colors[$color] }}">
    {{ $slot }}
</button>

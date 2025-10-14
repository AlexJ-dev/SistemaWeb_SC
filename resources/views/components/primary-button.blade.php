@props(['type' => 'submit'])

<button {{ $attributes->merge([
    'type' => $type,
    'class' => '
        w-full
        px-4 py-2
        bg-[#9C1C2A]
        hover:bg-[#80101F]
        text-white
        font-semibold
        text-sm
        rounded-md
        focus:outline-none
        focus:ring-2
        focus:ring-[#9C1C2A]
        transition
        ease-in-out
        duration-150
    '
]) }}>
    {{ $slot }}
</button>

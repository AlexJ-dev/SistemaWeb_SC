@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => '
            w-full
            px-4 py-2
            border border-[#9C1C2A]
            rounded-md
            shadow-sm
            text-[#4C4C4C]
            placeholder-[#9C1C2A]
            bg-white
            focus:outline-none
            focus:ring-2 focus:ring-[#9C1C2A]
            focus:border-[#9C1C2A]
            autofill:bg-white
        '
    ]) }}
>


@php
$navItems = [
['label' => 'Inicio', 'route' => 'inicio'],
['label' => 'Pacientes', 'route' => 'pacientes'],
['label' => 'Ficha Ocupacional', 'route' => 'ficha.ocupacional'],
['label' => 'Evaluaciones', 'route' => 'evaluaciones'],
['label' => 'Empresa', 'route' => 'empresa'],
['label' => 'Correos', 'route' => 'correos'],
['label' => 'Mantenimiento', 'route' => 'mantenimiento'],
];
@endphp

<div class="w-64 bg-[#9C1C2A] text-white flex flex-col justify-between min-h-screen">
    <!-- Logo y perfil -->
    <div class="px-6 py-4 border-b border-white/20">
        <div class="flex flex-col items-center">
            <div class="bg-white rounded-full p-2 mb-2">
                <img src="{{ asset('assets/aplication-logo-2.png') }}" alt="Logo Sagrado Corazón" class="w-16 h-16 object-contain" />
            </div>
            @if(Auth::check())
            <div class="px-4 py-2 border-b border-white/20 text-white text-sm text-center">
                <span class="font-semibold">{{ Auth::user()->name }}</span>
                <br>
                <span class="text-xs text-white/80">
                    {{ Auth::user()->personal->rol->nombre ?? 'Sin rol asignado' }}
                </span>
            </div>
            @endif

        </div>
    </div>

    <!-- Navegación -->
    <nav class="flex-1 px-4 py-6 space-y-2">
        @foreach ($navItems as $item)
        @php
        $isActive = request()->routeIs($item['route']);
        $baseClasses = 'block px-4 py-2 rounded transition';
        $activeClasses = $isActive ? 'bg-[#b91c1c] text-white' : 'hover:bg-[#b91c1c] text-white';
        @endphp
        <a href="{{ route($item['route']) }}" class="{{ $baseClasses }} {{ $activeClasses }}">
            {{ $item['label'] }}
        </a>
        @endforeach
    </nav>


    <!-- Cerrar sesión -->
    <div class="px-4 py-4 border-t border-white/20">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-[#b91c1c] transition text-white">
                Cerrar Sesión
            </button>
        </form>
    </div>

</div>
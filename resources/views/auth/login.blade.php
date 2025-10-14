<x-guest-layout>
    <div class="bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">

            <!-- Logo + Título -->
            <div class="flex flex-col items-center mb-6">
                <div class="w-32 h-32 mb-4 bg-white flex items-center justify-center">
                    <img src="{{ asset('assets/aplication-logo-2.png') }}" alt="Logo Sagrado Corazón" class="w-full h-full object-contain" />
                </div>

                <!-- Texto institucional -->
                <div class="text-center">
                    <p class="text-lg font-medium text-[#4C4C4C] leading-tight">Servicios Médicos</p>
                    <p class="text-xl font-bold text-[#9C1C2A] tracking-wide">SAGRADO CORAZÓN</p>
                </div>
            </div>


            <!-- Estado de sesión -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Formulario -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <h2 class="text-xl font-semibold text-[#4C4C4C] mb-6 text-center">
                    Inicio de Sesión
                </h2>

                <!-- Usuario -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Usuario')" class="text-[#4C4C4C]" />
                    <x-text-input id="name" type="text" name="name"
                        :value="old('name')" required autofocus
                        class="w-full px-4 py-2 border border-gray-300 rounded text-[#4C4C4C] focus:outline-none focus:ring-2 focus:ring-[#9C1C2A]" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Contraseña -->
                <div class="mb-6">
                    <x-input-label for="password" :value="__('Contraseña')" class="text-[#4C4C4C]" />
                    <x-text-input id="password" type="password" name="password"
                        required autocomplete="current-password"
                        class="w-full px-4 py-2 border border-gray-300 rounded text-[#4C4C4C] focus:outline-none focus:ring-2 focus:ring-[#9C1C2A]" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Recordarme 
                <div class="block mb-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="rounded border-gray-300 text-[#9C1C2A] shadow-sm focus:ring-[#9C1C2A]" />
                        <span class="ms-2 text-sm text-[#4C4C4C]">Recordarme</span>
                    </label>
                </div>-->

                <!-- Botón y recuperación -->
                 <!-- Botón -->
                <div class="flex justify-center">
                    <x-primary-button >
                        {{ __('Login') }}
                    </x-primary-button>
                </div>
                <!-- Recuperación de contraseña -->
                @if (Route::has('password.request'))
                <div class="mb-4 text-center">
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-[#4C4C4C] hover:underline">
                        ¿Olvidó su contraseña?
                    </a>
                </div>
                @endif

                

            </form>
        </div>
    </div>
</x-guest-layout>
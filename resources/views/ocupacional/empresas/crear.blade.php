<x-clinico-layout>
    <x-encabezado-clinico />

    <div class="p-6 bg-white rounded-lg shadow-md max-w-6xl mx-auto mt-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-6">Registrar Nueva Empresa</h2>

        <form action="{{ route('empresa.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Nombre y Nombre Abreviado --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <x-input-clinico label="Nombre o Razón Social" name="nombre" class="uppercase" required />
                </div>
                <div class="md:col-span-1">
                    <x-input-clinico label="Nombre Abreviado" name="nombre_abreviado" class="uppercase" required />
                </div>
            </div>

            {{-- Dirección --}}
            <div>
                <x-input-clinico label="Dirección" name="direccion" class="uppercase" />
            </div>

            {{-- RUC, Rubro, Teléfono y Email Empresa --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <x-input-clinico
                    label="RUC"
                    name="ruc"
                    maxlength="11"
                    required
                    oninput="this.value=this.value.replace(/[^0-9]/g,'')" />
                <x-input-clinico label="Rubro" name="rubro" class="uppercase" />
                <x-input-clinico
                    label="Teléfono"
                    name="telefono"
                    oninput="this.value=this.value.replace(/[^0-9]/g,'')" />
                <x-input-clinico label="Email de la Empresa" name="email" type="email" />
            </div>

            {{-- Persona, Teléfono y Email de Contacto --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-t border-gray-200 pt-6">
                <x-input-clinico label="Persona de Contacto" name="persona_contacto" class="uppercase" />
                <x-input-clinico
                    label="Teléfono de Contacto"
                    name="telefono_contacto"
                    oninput="this.value=this.value.replace(/[^0-9]/g,'')" />
                <x-input-clinico label="Email de Contacto" name="email_contacto" type="email" />
            </div>

            {{-- Departamento / Provincia / Distrito --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-t border-gray-200 pt-6">

                {{-- Departamento --}}
                <div class="flex flex-col md:flex-row items-center gap-2 mb-4">
                    <x-input-clinico
                        id="input_departamento"
                        label="Departamento Seleccionado"
                        name="departamento"
                        readonly
                        class="w-full" />

                    <div class="relative">
                        <select
                            id="departamento"
                            data-old="{{ old('departamento') }}"
                            class="border border-gray-300 focus:border-[#9C1C2A] focus:ring-[#9C1C2A] rounded-md h-[42px] w-[42px] cursor-pointer bg-white mt-2">
                            <option value="">▼</option>
                        </select>
                    </div>
                </div>

                {{-- Provincia --}}
                <div class="flex flex-col md:flex-row items-center gap-2 mb-4">
                    <x-input-clinico
                        id="input_provincia"
                        label="Provincia Seleccionada"
                        name="provincia"
                        readonly
                        class="w-full" />

                    <div class="relative">
                        <select
                            id="provincia"
                            data-old="{{ old('provincia') }}"
                            class="border border-gray-300 focus:border-[#9C1C2A] focus:ring-[#9C1C2A] rounded-md h-[42px] w-[42px] cursor-pointer bg-white mt-2">
                            <option value="">▼</option>
                        </select>
                    </div>
                </div>

                {{-- Distrito --}}
                <div class="flex flex-col md:flex-row items-center gap-2 mb-4">
                    <x-input-clinico
                        id="input_distrito"
                        label="Distrito Seleccionado"
                        name="distrito"
                        readonly
                        class="w-full" />

                    <div class="relative">
                        <select
                            id="distrito"
                            data-old="{{ old('distrito') }}"
                            class="border border-gray-300 focus:border-[#9C1C2A] focus:ring-[#9C1C2A] rounded-md h-[42px] w-[42px] cursor-pointer bg-white mt-2">
                            <option value="">▼</option>
                        </select>
                    </div>
                </div>

            </div>


            {{-- Botones --}}
            <div class="flex justify-end mt-6 space-x-3">
                <a href="{{ route('empresa') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">
                    Cancelar
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-[#9C1C2A] text-white rounded-lg hover:bg-[#b91c1c] transition">
                    Guardar
                </button>
            </div>
        </form>
    </div>
    
</x-clinico-layout>
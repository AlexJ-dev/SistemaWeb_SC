<div id="empresaModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
    <div class="bg-white w-full max-w-lg rounded-lg shadow-lg p-6">
        <h2 id="empresaModalTitle" class="text-lg font-semibold mb-4 text-gray-700">Seleccionar empresa</h2>

        <input type="text"
               id="buscarEmpresa"
               placeholder="Buscar empresa..."
               class="w-full border rounded px-3 py-2 mb-3 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">

        <ul id="listaEmpresas" class="max-h-60 overflow-y-auto divide-y"></ul>

        <div class="flex justify-end mt-4">
            <button id="cerrarEmpresaModal" class="px-4 py-2 rounded bg-gray-500 text-white hover:bg-gray-600">Cerrar</button>
        </div>
    </div>
</div>

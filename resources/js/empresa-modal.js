document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("empresaModal");
    const lista = document.getElementById("listaEmpresas");
    const buscador = document.getElementById("buscarEmpresa");
    const cerrar = document.getElementById("cerrarEmpresaModal");

    let empresas = [];
    let inputDestino = null;

    // Exponer función global para abrir modal desde vistas
    window.abrirModalEmpresa = function (inputId) {
        inputDestino = document.getElementById(inputId);
        if (!inputDestino) {
            console.error("abrirModalEmpresa: no existe input con id", inputId);
            return;
        }

        document.getElementById('empresaModalTitle').innerText = inputId === 'contratista' ? 'Seleccionar Contratista' : 'Seleccionar Empresa';
        buscador.value = '';
        modal.classList.remove("hidden");

        if (empresas.length === 0) {
            cargarEmpresas();
        } else {
            renderizar(empresas);
        }
    };

    function cargarEmpresas() {
        fetch("/empresas/listado")
            .then(res => {
                if (!res.ok) throw new Error("Status " + res.status);
                return res.json();
            })
            .then(data => {
                empresas = data;
                renderizar(empresas);
            })
            .catch(err => {
                console.error("Error cargando empresas:", err);
                lista.innerHTML = `<li class="px-3 py-2 text-red-600">No se pudo cargar empresas</li>`;
            });
    }

    function renderizar(data) {
        lista.innerHTML = "";
        if (!data.length) {
            lista.innerHTML = `<li class="px-3 py-2 text-gray-600">No hay empresas</li>`;
            return;
        }

        data.forEach(emp => {
            const item = document.createElement("li");
            item.className = "px-3 py-2 hover:bg-gray-100 cursor-pointer flex justify-between items-center";
            item.innerHTML = `<span>${escapeHtml(emp.nombre)}</span><small class="text-gray-500">(${escapeHtml(emp.nombre_abreviado)})</small>`;

            item.onclick = () => {
                inputDestino.value = emp.nombre_abreviado;
                modal.classList.add("hidden");
            };

            lista.appendChild(item);
        });
    }

    buscador.addEventListener("input", () => {
        const texto = buscador.value.toLowerCase().trim();
        const filtrado = empresas.filter(e =>
            (e.nombre || '').toLowerCase().includes(texto) ||
            (e.nombre_abreviado || '').toLowerCase().includes(texto)
        );
        renderizar(filtrado);
    });

    cerrar.addEventListener("click", () => modal.classList.add("hidden"));

    // simple escape para evitar injection en innerHTML
    function escapeHtml(s) {
        return String(s).replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[m]);
    }
});

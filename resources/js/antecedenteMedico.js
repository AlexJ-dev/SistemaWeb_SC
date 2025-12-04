// resources/js/antecedenteMedico.js

document.addEventListener('DOMContentLoaded', () => {
    // === Botones "Añadir" dinámicos ===
    document.querySelectorAll('.add-field').forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.dataset.target; // ej: "cirugias-container"
            const container = document.getElementById(targetId);
            if (!container) return;

            // Buscar la última fila para clonar
            const prototype = container.querySelector('.flex.items-center') || container.firstElementChild;

            if (prototype) {
                const clone = prototype.cloneNode(true);

                // Limpiar valor del input o textarea dentro del clon
                const input = clone.querySelector('input, textarea, select');
                if (input) input.value = '';

                // Asegurar que el botón de eliminar funcione en el clon
                const removeBtn = clone.querySelector('.remove-field');
                if (removeBtn) {
                    removeBtn.replaceWith(removeBtn.cloneNode(true));
                }

                container.appendChild(clone);
            } else {
                // Si no hay prototipo, crear una fila nueva básica
                const nameBase = targetId.replace('-container', '');
                const div = document.createElement('div');
                div.className = 'flex items-center mb-2';
                div.innerHTML = `
                    <input type="text" name="antecedentes_medicos[${nameBase}][]" 
                        class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-[#9C1C2A] focus:border-[#9C1C2A]" />
                    <button type="button" class="ml-2 text-red-500 remove-field">✖</button>
                `;
                container.appendChild(div);
            }
        });
    });

    // === Delegación para los botones de eliminar ===
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-field')) {
            const row = e.target.closest('.flex.items-center') || e.target.parentElement;
            if (row) row.remove();
        }
    });
});

// === Grupo Sanguíneo ===
document.addEventListener('DOMContentLoaded', () => {
    const grupoRadios = document.querySelectorAll('input[name="grupo"]');
    const rhRadios = document.querySelectorAll('input[name="rh"]');
    const grupoSanguineo = document.getElementById('grupo_sanguineo');

    function actualizarGrupoSanguineo() {
        const grupo = document.querySelector('input[name="grupo"]:checked')?.value || '';
        const rh = document.querySelector('input[name="rh"]:checked')?.value || '';
        grupoSanguineo.value = grupo && rh ? `${grupo}${rh}` : '';
    }

    grupoRadios.forEach(radio => radio.addEventListener('change', actualizarGrupoSanguineo));
    rhRadios.forEach(radio => radio.addEventListener('change', actualizarGrupoSanguineo));

    actualizarGrupoSanguineo(); // inicializar si ya hay valores guardados
});

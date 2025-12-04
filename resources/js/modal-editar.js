// resources/js/modal-editar.js
document.addEventListener('DOMContentLoaded', function() {
    console.log("✅ modal-editar.js cargado correctamente");

    // Selecciona todos los botones editar (cada uno debe tener data-id="{{ $p->id }}" y clase btn-editar)
    const editButtons = document.querySelectorAll('.btn-editar');

    editButtons.forEach(button => {
        const id = button.dataset.id;
        if (!id) return;

        const modalId = `modal-editar-${id}`;
        const modal = document.getElementById(modalId);
        if (!modal) return;

        // Local scope: elementos dentro del modal
        const form = modal.querySelector('form');
        const dniInput = modal.querySelector('input[name="dni"]');
        const dniErrorEl = modal.querySelector('.dni-edit-error') || modal.querySelector('#dni-edit-error');
        const telefonoInput = modal.querySelector('input[name="telefono"]');
        const cmpInput = modal.querySelector('input[name="cmp"]') || document.getElementById(`cmp-${id}`);
        const especialidadSelect = modal.querySelector('select[name="especialidad_id"]') || document.getElementById(`especialidad_id-${id}`);
        const rolSelect = modal.querySelector('select[name="rol_id"]') || document.getElementById(`rol_id-${id}`);
        const fechaInput = modal.querySelector('input[name="fecha_nacimiento"]');
        const edadInput = modal.querySelector('input[name="edad"]');
        // Botón cancelar: busca un botón que cierre el dialog (onclick contains .close()) o botón[type="button"]
        let btnCancelar = modal.querySelector('button.btn-cancelar');
        if (!btnCancelar) {
            btnCancelar = Array.from(modal.querySelectorAll('button[type="button"]')).find(b => b.getAttribute('onclick')?.includes('.close')) || modal.querySelector('button[type="button"]');
        }

        // Control para evitar verificar mientras cancelan
        let verificarActivo = true;

        // UTIL: muestra/oculta error DNI
        function showDniError(msg) {
            if (!dniErrorEl) return;
            dniErrorEl.textContent = msg || '';
            dniErrorEl.classList.toggle('hidden', !msg);
            if (msg) {
                dniInput.classList.add('border-red-500');
                dniInput.focus();
            } else {
                dniInput.classList.remove('border-red-500');
            }
        }

        // UTIL: AJAX verifica DNI (devuelve true si DUPLICADO)
        async function verificarDniAjax(dni, id) {
            if (!verificarActivo) return false;
            try {
                const res = await fetch(`/verificar-dni-editar/${dni}/${id}`, { cache: 'no-store' });
                if (!res.ok) return false;
                return await res.json();
            } catch (e) {
                console.error('Error verificarDniAjax', e);
                return false;
            }
        }

        // === Solo números en campos ===
        function attachNumericOnly(el) {
            if (!el) return;
            el.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });
        }
        attachNumericOnly(dniInput);
        attachNumericOnly(telefonoInput);
        attachNumericOnly(cmpInput);

        // === Toggle CMP / Especialidad según rol ===
        function toggleCamposMedico() {
            if (!rolSelect) return;
            // normaliza texto por si hay acentos
            const selectedText = (rolSelect.options[rolSelect.selectedIndex]?.text || '')
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '');
            const esMedico = selectedText.includes('medico');

            if (cmpInput) {
                cmpInput.disabled = !esMedico;
                cmpInput.readOnly = !esMedico;
                if (!esMedico) cmpInput.value = '';
            }
            if (especialidadSelect) {
                especialidadSelect.disabled = !esMedico;
                if (!esMedico) especialidadSelect.value = '';
            }
        }

        // === Calcular edad si existe fecha input (igual que en registro) ===
        if (fechaInput && edadInput) {
            fechaInput.addEventListener('change', function() {
                const fecha = new Date(this.value);
                if (!isNaN(fecha)) {
                    const hoy = new Date();
                    let edad = hoy.getFullYear() - fecha.getFullYear();
                    const m = hoy.getMonth() - fecha.getMonth();
                    if (m < 0 || (m === 0 && hoy.getDate() < fecha.getDate())) edad--;
                    edadInput.value = edad;
                }
            });
        }

        // === Al abrir el modal: asegurar estado según rol actual ===
        button.addEventListener('click', function() {
            // Limpiar mensajes previos
            showDniError('');
            verificarActivo = true;

            // Ejecuta toggleCamposMedico para el estado inicial
            toggleCamposMedico();

            // (re)attach listener de change del rol dentro del modal
            if (rolSelect) {
                // para evitar multiples listeners, removemos antes (si existiera)
                rolSelect.removeEventListener('change', toggleCamposMedico);
                rolSelect.addEventListener('change', toggleCamposMedico);
            }
        });

        // === Validaciones DNI ===
        if (dniInput) {
            dniInput.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '').slice(0, 8);
                showDniError('');
            });

            dniInput.addEventListener('blur', async function() {
                const dni = this.value.trim();
                if (!dni) { showDniError(''); return; }
                if (dni.length !== 8) { showDniError('El DNI debe tener exactamente 8 dígitos.'); return; }

                const existe = await verificarDniAjax(dni, id);
                if (existe) showDniError('Este DNI ya está registrado en otro personal.');
            });
        }

        // === Envío del formulario: interceptamos para validar DNI por AJAX y evitar cerrar modal si hay error ===
        if (form) {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                // validar formato DNI
                const dni = dniInput ? dniInput.value.trim() : '';
                if (!dni) { if (dniInput) showDniError('El DNI es obligatorio.'); return; }
                if (dni.length !== 8) { if (dniInput) showDniError('El DNI debe tener exactamente 8 dígitos.'); return; }

                // verificar duplicado (permitir si es el mismo registro)
                const existe = await verificarDniAjax(dni, id);
                if (existe) {
                    if (dniInput) showDniError('Este DNI ya está registrado en otro personal.');
                    return; // NO enviamos el formulario ni se cerrará el modal
                }

                // Si todo OK -> enviar formulario
                form.submit();
            });
        }

        // === Cancelar: limpiar y desactivar verificación temporal ===
        if (btnCancelar) {
            btnCancelar.addEventListener('click', function() {
                verificarActivo = false;
                if (dniInput) dniInput.value = '';
                showDniError('');
                // restaurar verificación después de un corto delay
                setTimeout(() => (verificarActivo = true), 300);
            });
        }
    }); // end foreach
});

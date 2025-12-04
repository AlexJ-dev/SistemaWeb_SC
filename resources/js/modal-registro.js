document.addEventListener('DOMContentLoaded', function() {
    const modalForm = document.querySelector('#modal-registro form');
    if (!modalForm) return;

    const rolSelect = modalForm.querySelector('select[name="rol_id"]');
    const cmpInput = modalForm.querySelector('input[name="cmp"]');
    const especialidadSelect = modalForm.querySelector('select[name="especialidad_id"]');
    const fechaInput = modalForm.querySelector('input[name="fecha_nacimiento"]');
    const edadInput = modalForm.querySelector('input[name="edad"]');
    const dniInput = modalForm.querySelector('input[name="dni"]');
    const dniError = document.getElementById('dni-error');
    const telefonoInput = document.getElementById('telefono');
    const btnCancelar = modalForm.querySelector('.btn-cancelar');
    

    if (cmpInput) {
        cmpInput.addEventListener("input", function () {
            // Permite solo números (elimina cualquier letra o símbolo)
            cmpInput.value = cmpInput.value.replace(/\D/g, '');
        });
    }
    let verificarActivo = true;

    // --- Mostrar/Ocultar CMP y Especialidad ---
    function toggleCamposMedico() {
        const selectedText = rolSelect.options[rolSelect.selectedIndex].text
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '');
        const esMedico = selectedText.includes('medico');

        cmpInput.disabled = !esMedico;
        especialidadSelect.disabled = !esMedico;
        cmpInput.readOnly = !esMedico;

        if (!esMedico) {
            cmpInput.value = '';
            especialidadSelect.value = '';
        }
    }
    rolSelect.addEventListener('change', toggleCamposMedico);
    toggleCamposMedico();

    // --- Calcular edad ---
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

    // --- Validación de DNI ---
    function showDniError(msg) {
        dniError.textContent = msg || '';
        dniError.classList.toggle('hidden', !msg);
        dniInput.classList.toggle('border-red-500', !!msg);
    }

    async function verificarDniAjax(dni) {
        if (!verificarActivo) return false;
        try {
            const res = await fetch(`/verificar-dni/${dni}`, { cache: 'no-store' });
            if (!res.ok) return false;
            return await res.json();
        } catch {
            return false;
        }
    }

    dniInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').slice(0, 8);
        showDniError('');
    });

    dniInput.addEventListener('blur', async function() {
        const dni = this.value.trim();
        if (!dni) return showDniError('');
        if (dni.length !== 8) return showDniError('El DNI debe tener exactamente 8 dígitos.');

        const exists = await verificarDniAjax(dni);
        if (exists) showDniError('Este DNI ya está registrado. Verifique bien.');
    });

    modalForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const dni = dniInput.value.trim();

        if (!dni) return showDniError('El DNI es obligatorio.');
        if (dni.length !== 8) return showDniError('El DNI debe tener exactamente 8 dígitos.');

        const exists = await verificarDniAjax(dni);
        if (exists) return showDniError('Este DNI ya está registrado. Modifícalo antes de guardar.');

        modalForm.submit();
    });

    // --- Limpiar al cancelar ---
    if (btnCancelar) {
        btnCancelar.addEventListener('click', function() {
            verificarActivo = false;
            dniInput.value = '';
            showDniError('');
            setTimeout(() => (verificarActivo = true), 500);
        });
    }

    // --- Validar solo números en teléfono ---
    telefonoInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});

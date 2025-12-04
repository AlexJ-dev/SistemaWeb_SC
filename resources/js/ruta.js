document.addEventListener("DOMContentLoaded", () => {
    // --- Validación de documento ---
    const tipoDocumento = document.getElementById("tipo_documento");
    const documento = document.getElementById("documento");
    const errorMsg = document.getElementById("error-documento");
    const form = document.getElementById("rutaForm");

    const LIMITES = {
        'DNI': { min: 8, max: 8 },
        'C. Extranjería': { min: 5, max: 12 },
        'Pasaporte': { min: 6, max: 9 }
    };

    function ajustarRestricciones() {
        const tipo = (tipoDocumento.value || '').trim();
        const { max } = LIMITES[tipo] || { max: 12 };
        documento.setAttribute('maxlength', String(max));

        if (tipo === 'DNI') {
            documento.setAttribute('inputmode', 'numeric');
            documento.setAttribute('pattern', '^[0-9]{8}$');
            documento.setAttribute('title', 'El DNI debe tener exactamente 8 números.');
        } else {
            documento.removeAttribute('inputmode');
            documento.removeAttribute('pattern');
            documento.removeAttribute('title');
        }

        if (documento.value.length > max) {
            documento.value = documento.value.slice(0, max);
        }

        errorMsg.classList.add('hidden');
        documento.classList.remove('border-red-500');
    }

    function validarDocumento() {
        const tipo = (tipoDocumento.value || '').trim();
        const valor = (documento.value || '').trim();
        let valido = true;
        let mensaje = '';

        documento.classList.remove('border-red-500');
        errorMsg.classList.add('hidden');
        errorMsg.textContent = '';

        if (!valor) {
            valido = false;
            mensaje = 'El número de documento es obligatorio.';
        } else if (LIMITES[tipo]) {
            const { min, max } = LIMITES[tipo];
            if (tipo === 'DNI' && !/^\d{8}$/.test(valor)) {
                valido = false;
                mensaje = 'El DNI debe contener exactamente 8 números.';
            } else if ((tipo === 'C. Extranjería' || tipo === 'Pasaporte') &&
                (valor.length < min || valor.length > max || !/^[A-Za-z0-9]+$/.test(valor))) {
                valido = false;
                mensaje = tipo === 'C. Extranjería' ?
                    `El Carnet de Extranjería debe tener entre ${min} y ${max} caracteres alfanuméricos.` :
                    `El Pasaporte debe tener entre ${min} y ${max} caracteres alfanuméricos.`;
            }
        } else {
            valido = false;
            mensaje = 'Seleccione un tipo de documento válido.';
        }

        if (!valido) {
            documento.classList.add('border-red-500');
            errorMsg.textContent = mensaje;
            errorMsg.classList.remove('hidden');
        }

        return valido;
    }

    tipoDocumento.addEventListener('change', () => {
        ajustarRestricciones();
        if (documento.value) validarDocumento();
    });

    documento.addEventListener('input', () => {
        const tipo = (tipoDocumento.value || '').trim();
        const max = (LIMITES[tipo] || { max: 12 }).max;

        if (tipo === 'DNI') documento.value = documento.value.replace(/[^0-9]/g, '');
        if (documento.value.length > max) documento.value = documento.value.slice(0, max);

        validarDocumento();
    });

    form.addEventListener('submit', (e) => {
        if (!validarDocumento()) {
            e.preventDefault();
            documento.focus();
        }
    });

    ajustarRestricciones();

    // --- Campos en mayúsculas ---
    const camposMayus = ["nombres", "apellidos", "cargo", "empresa", "documento"];
    camposMayus.forEach(id => {
        const input = document.getElementById(id);
        if (input) {
            input.addEventListener("input", () => { input.value = input.value.toUpperCase(); });
        }
    });

    form.addEventListener("submit", () => {
        camposMayus.forEach(id => {
            const input = document.getElementById(id);
            if (input) input.value = input.value.toUpperCase();
        });
    });
});

document.getElementById("documento").addEventListener("blur", async function() {
    const dni = this.value.trim();
    if (!dni) return;

    try {
        const res = await fetch(`/verificar-paciente/${dni}`);
        const data = await res.json();

        if (data.existe) {
            // Llenar campos automáticamente
            document.getElementById("nombres").value = data.paciente.nombres.toUpperCase();
            document.getElementById("apellidos").value = data.paciente.apellidos.toUpperCase();
        } 

    } catch (error) {
        console.error("Error verificando DNI:", error);
    }
});


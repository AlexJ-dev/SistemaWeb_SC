console.log("✅ usuarios.js cargado correctamente");

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form-usuario");
    if (!form) return;

    const nameInput = document.getElementById("name");
    const passwordInput = document.getElementById("password");
    const personalSelect = document.getElementById("personal_id");
    const nameError = document.getElementById("name-error");
    const passwordError = document.getElementById("password-error");
    const submitBtn = form.querySelector('button[type="submit"]');
    const cancelarBtn = document.getElementById("cancelar-btn");

    let usuarioExistente = false;
    let passwordExistente = false;

    // Copiar credenciales (tabla)
    window.copiarCredenciales = function (usuario, contraseña) {
        const texto = `${usuario} / ${contraseña}`;
        navigator.clipboard.writeText(texto).then(() => {
            console.log("Credenciales copiadas:", texto);
        });
    };

    function showError(input, errorElement, message) {
        errorElement.textContent = message || "";
        errorElement.classList.toggle("hidden", !message);
        input.classList.toggle("border-red-500", !!message);
    }

    async function verificarUsuarioPassword(usuario, password) {
        if (!usuario && !password)
            return { name: false, password: false };
        try {
            const url = `/verificar-usuario/${encodeURIComponent(usuario || "_")}/${encodeURIComponent(password || "_")}`;
            const res = await fetch(url, { cache: "no-store" });
            if (!res.ok) return { name: false, password: false };
            return await res.json();
        } catch {
            return { name: false, password: false };
        }
    }

    // Nombre de usuario
    nameInput.addEventListener("input", async function () {
        nameInput.value = nameInput.value.toUpperCase();
        const usuario = nameInput.value.trim();

        if (!usuario) {
            showError(nameInput, nameError, "El nombre de usuario es obligatorio.");
            usuarioExistente = true;
        } else {
            const data = await verificarUsuarioPassword(usuario, "");
            usuarioExistente = data.name;
            showError(nameInput, nameError, usuarioExistente ? "Este nombre de usuario ya está registrado." : "");
        }
        validarFormulario();
    });

    // Contraseña
    passwordInput.addEventListener("input", async function () {
        const password = passwordInput.value.trim();
        if (!password) {
            showError(passwordInput, passwordError, "La contraseña es obligatoria.");
            passwordExistente = true;
        } else if (password.length < 6) {
            showError(passwordInput, passwordError, "Debe tener al menos 6 caracteres.");
            passwordExistente = true;
        } else {
            const data = await verificarUsuarioPassword("", password);
            passwordExistente = data.password;
            showError(passwordInput, passwordError, passwordExistente ? "Esta contraseña ya está registrada." : "");
        }
        validarFormulario();
    });

    personalSelect.addEventListener("change", validarFormulario);

    function validarFormulario() {
        const usuario = nameInput.value.trim();
        const password = passwordInput.value.trim();
        const personal = personalSelect.value.trim();

        const errores = !usuario || !password || password.length < 6 || !personal || usuarioExistente || passwordExistente;
        submitBtn.disabled = errores;
        submitBtn.classList.toggle("opacity-50", errores);
        submitBtn.classList.toggle("cursor-not-allowed", errores);
    }

    // Cancelar
    cancelarBtn.addEventListener("click", function () {
        form.reset();
        [nameError, passwordError].forEach(e => {
            e.classList.add("hidden");
            e.textContent = "";
        });
        [nameInput, passwordInput].forEach(i => i.classList.remove("border-red-500"));
        validarFormulario();
    });

    form.addEventListener("submit", function (e) {
        validarFormulario();
        if (submitBtn.disabled) e.preventDefault();
    });
});

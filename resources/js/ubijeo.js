document.addEventListener("DOMContentLoaded", async () => {
    const grupos = [{
        selectDep: "departamento",
        selectProv: "provincia",
        selectDist: "distrito",
        inputDep: "input_departamento",
        inputProv: "input_provincia",
        inputDist: "input_distrito"
    }];

    try {
        const [departamentos, provincias, distritos] = await Promise.all([
            fetch("/ubigeo/ubigeo_peru_2016_departamentos.json").then(r => r.json()),
            fetch("/ubigeo/ubigeo_peru_2016_provincias.json").then(r => r.json()),
            fetch("/ubigeo/ubigeo_peru_2016_distritos.json").then(r => r.json()),
        ]);

        grupos.forEach(grupo => {
            const depSelect = document.getElementById(grupo.selectDep);
            const provSelect = document.getElementById(grupo.selectProv);
            const distSelect = document.getElementById(grupo.selectDist);
            const inputDep = document.getElementById(grupo.inputDep);
            const inputProv = document.getElementById(grupo.inputProv);
            const inputDist = document.getElementById(grupo.inputDist);

            if (!depSelect || !provSelect || !distSelect) return;

            const depSaved = depSelect?.dataset.old || "";
            const provSaved = provSelect?.dataset.old || "";
            const distSaved = distSelect?.dataset.old || "";

            // Cargar departamentos
            departamentos.forEach(dep => {
                const opt = document.createElement("option");
                opt.value = dep.name;
                opt.textContent = dep.name;
                if (dep.name === depSaved) opt.selected = true;
                depSelect.appendChild(opt);
            });

            inputDep.value = depSaved;
            inputProv.value = provSaved;
            inputDist.value = distSaved;

            // Cargar provincias si ya hay un departamento
            if (depSaved) {
                const depId = departamentos.find(d => d.name === depSaved)?.id;
                const provinciasFiltradas = provincias.filter(p => p.department_id === depId);

                provinciasFiltradas.forEach(prov => {
                    const opt = document.createElement("option");
                    opt.value = prov.name;
                    opt.textContent = prov.name;
                    if (prov.name === provSaved) opt.selected = true;
                    provSelect.appendChild(opt);
                });

                // Cargar distritos si ya hay una provincia
                if (provSaved) {
                    const provId = provincias.find(p => p.name === provSaved && p.department_id === depId)?.id;
                    const distritosFiltrados = distritos.filter(d => d.province_id === provId);

                    distritosFiltrados.forEach(dist => {
                        const opt = document.createElement("option");
                        opt.value = dist.name;
                        opt.textContent = dist.name;
                        if (dist.name === distSaved) opt.selected = true;
                        distSelect.appendChild(opt);
                    });
                }
            }

            // Eventos dinámicos
            depSelect.addEventListener("change", () => {
                const depId = departamentos.find(d => d.name === depSelect.value)?.id;
                inputDep.value = depSelect.value;
                inputProv.value = "";
                inputDist.value = "";

                provSelect.innerHTML = '<option value="">Seleccione</option>';
                distSelect.innerHTML = '<option value="">Seleccione</option>';

                const provinciasFiltradas = provincias.filter(p => p.department_id === depId);
                provinciasFiltradas.forEach(prov => {
                    const opt = document.createElement("option");
                    opt.value = prov.name;
                    opt.textContent = prov.name;
                    provSelect.appendChild(opt);
                });
            });

            provSelect.addEventListener("change", () => {
                const provId = provincias.find(p => p.name === provSelect.value)?.id;
                inputProv.value = provSelect.value;
                inputDist.value = "";

                distSelect.innerHTML = '<option value="">Seleccione</option>';

                const distritosFiltrados = distritos.filter(d => d.province_id === provId);
                distritosFiltrados.forEach(dist => {
                    const opt = document.createElement("option");
                    opt.value = dist.name;
                    opt.textContent = dist.name;
                    distSelect.appendChild(opt);
                });
            });

            distSelect.addEventListener("change", () => {
                inputDist.value = distSelect.value;
            });
        });

    } catch (error) {
        console.error("Error cargando datos de ubigeo:", error);
    }
});

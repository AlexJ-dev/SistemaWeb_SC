<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\RutaMedicaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\EspecialidadOcupacionalController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AreaOcupacionalController;
use App\Http\Controllers\HistoriaClinicaController;
use App\Http\Controllers\FichaOcupacionalController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\EmpresaController;
use App\Models\Personal;
use App\Http\Controllers\AdmisionController;
use App\Http\Controllers\TriajeController;
use App\Http\Controllers\HistoriaOcupacionalController;
use App\Http\Controllers\OftalmologiaController;
use App\Http\Controllers\AudiometriaController;
use App\Http\Controllers\EspirometriaController;
use App\Http\Controllers\PsicologiaController;
use App\Http\Controllers\RadiografiaController;
use App\Http\Controllers\FichaDetalleController;
/*Redirección inicial



*/

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('inicio')
        : redirect()->route('login');
});

/*
| LOGIN / LOGOUT (solo invitados)
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

/*
| Logout
*/
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
| RUTAS PROTEGIDAS POR AUTENTICACIÓN (todas requieren login)
*/
Route::middleware('auth')->group(function () {



    //| Dashboard
    Route::get('/dashboard', fn() => redirect()->route('inicio'))->name('dashboard');

    Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');

    /*

    | Pacientes (ACCESIBLE PARA TODOS LOS ROLES)

    */
    Route::get('/pacientes', [PacienteController::class, 'index'])->name('pacientes');


    /*

    | Ruta Médica (TODOS)

    */
    Route::get('/ruta-medica/crear', [RutaMedicaController::class, 'create'])->name('ruta.crear');
    Route::post('/ruta-medica', [RutaMedicaController::class, 'store'])->name('ruta.store');
    Route::get('/ruta-medica/{id}', [RutaMedicaController::class, 'ver'])->name('ruta.ver');

    Route::get('/verificar-paciente/{dni}', [RutaMedicaController::class, 'verificarPaciente'])
        ->name('ruta.verificar');

    Route::post('/ocupacional/ruta/{id}/guardar-evaluaciones', [RutaMedicaController::class, 'guardarEvaluaciones'])
        ->name('ruta.guardarEvaluaciones');


    /*

    | Evaluaciones (TODOS)

    */
    Route::prefix('evaluaciones')->group(function () {
        Route::get('/', [EvaluacionController::class, 'index'])->name('evaluaciones');
        Route::get('/{id}/ver', [EvaluacionController::class, 'ver'])->name('evaluaciones.ver');
        Route::post('/{id}/actualizar', [EvaluacionController::class, 'actualizar'])->name('evaluaciones.actualizar');
        Route::post('/{id}/completar', [EvaluacionController::class, 'completar'])->name('evaluaciones.completar');
    });

    Route::post('/evaluaciones/{id}/iniciar', [EvaluacionController::class, 'iniciarEvaluacion'])
        ->name('evaluaciones.iniciar');

    Route::post('/evaluaciones/{id}/finalizar', [EvaluacionController::class, 'finalizarEvaluacion'])
        ->name('evaluaciones.finalizar');

    Route::get('/evaluaciones/continuar/{ruta}', [EvaluacionController::class, 'continuar'])
        ->name('evaluaciones.continuar');

    Route::get('/evaluaciones/{id}/area', [EvaluacionController::class, 'show'])->name('evaluaciones.show');

    Route::post('/evaluaciones/{id}/reiniciar', [EvaluacionController::class, 'reiniciarEvaluacion'])
        ->name('evaluaciones.reiniciar');

    /*

    | Ficha Ocupacional (TODOS)

    */
    Route::get('/ocupacional/ficha/crear/{id}', [FichaOcupacionalController::class, 'crear'])
        ->name('ocupacional.fichas.crear');

    Route::post('/ocupacional/ficha/guardar', [FichaOcupacionalController::class, 'guardar'])
        ->name('ocupacional.fichas.guardar');

    Route::get('/ocupacional/ficha/{id}/editar', [FichaOcupacionalController::class, 'editar'])
        ->name('ocupacional.fichas.editar');

    Route::put('/ocupacional/ficha/{id}/actualizar', [FichaOcupacionalController::class, 'actualizar'])
        ->name('ocupacional.fichas.actualizar');


    /*

    | Historia Clínica (TODOS)

    */
    Route::get('/historia/{dni}/editar', [HistoriaClinicaController::class, 'editar'])
        ->name('historiaClinica.editar');

    Route::post('/historia/{dni}/actualizar', [HistoriaClinicaController::class, 'actualizar'])
        ->name('historiaClinica.actualizar');


    /* Vista Fichas + Correos */
    Route::get('/ocupacional/fichas', [FichaOcupacionalController::class, 'index'])
        ->name('ficha_ocupacional');

    Route::view('/correos', 'ocupacional.correos')->name('correos');



    //DETALLE/INFROMACION DE LA FICHA OCUPACIONAL

    Route::get('/fichas/{ficha}/detalle', [FichaDetalleController::class, 'show'])
        ->name('fichas.detalle');



    // HISTORIAL OCUPACIONAL
    Route::prefix('historia')->name('historia.')->group(function () {

        // Mostrar todo el historial de un paciente
        Route::get('/{paciente_id}', [HistoriaOcupacionalController::class, 'index'])
            ->name('index');

        // Crear nuevo registro del historial
        Route::get('/{paciente_id}/crear', [HistoriaOcupacionalController::class, 'crear'])
            ->name('crear');

        Route::post('/{paciente_id}', [HistoriaOcupacionalController::class, 'store'])
            ->name('store');

        // Editar un historial
        Route::get('/edit/{id}', [HistoriaOcupacionalController::class, 'edit'])
            ->name('edit');

        Route::put('/update/{id}', [HistoriaOcupacionalController::class, 'update'])
            ->name('update');

        // Eliminar un historial
        Route::delete('/delete/{id}', [HistoriaOcupacionalController::class, 'destroy'])
            ->name('destroy');
    });



    /* EVALUACIONES POR AREA*/
    Route::get('/evaluaciones/{id}/editar', [EvaluacionController::class, 'editar'])
        ->name('evaluaciones.editar');


    /*AREA ADMISION LLEFDO DE DATOS */
    // Mostrar formulario de admisión (con datos cargados si existen)
    Route::get('/evaluaciones/{evaluacion}/admision', [AdmisionController::class, 'edit'])
        ->name('admision.edit');

    // Guardar o actualizar datos de admisión
    Route::put('/evaluaciones/{evaluacion}/admision', [AdmisionController::class, 'update'])
        ->name('admision.update');



    // TRIAJE
    Route::get('/evaluaciones/{evaluacion}/triaje/editar', [TriajeController::class, 'edit'])
        ->name('triaje.edit');
    Route::post('/evaluaciones/{evaluacion}/triaje', [TriajeController::class, 'store'])
        ->name('triaje.store');

    // OFTALMOLOGIA
    Route::get('/evaluaciones/{evaluacion}/oftalmologia/editar', [OftalmologiaController::class, 'edit'])
        ->name('evaluaciones.oftalmologia.edit');
    Route::post('/evaluaciones/{evaluacion}/oftalmologia', [OftalmologiaController::class, 'store'])
        ->name('evaluaciones.oftalmologia.store');

    // AUDIOMETRIA
    Route::get('/evaluaciones/{evaluacion}/audiometria/editar', [AudiometriaController::class, 'edit'])
        ->name('evaluaciones.audiometria.edit');
    Route::post('/evaluaciones/{evaluacion}/audiometria', [AudiometriaController::class, 'store'])
        ->name('evaluaciones.audiometria.store');

    // ESPIROMETRIA
    Route::get('/evaluaciones/{evaluacion}/espirometria/editar', [EspirometriaController::class, 'edit'])
        ->name('evaluaciones.espirometria.edit');
    Route::post('/evaluaciones/{evaluacion}/espirometria', [EspirometriaController::class, 'store'])
        ->name('evaluaciones.espirometria.store');

    // PSICOLOGIA
    Route::get('/evaluaciones/{evaluacion}/psicologia/editar', [PsicologiaController::class, 'edit'])
        ->name('evaluaciones.psicologia.edit');
    Route::post('/evaluaciones/{evaluacion}/psicologia', [PsicologiaController::class, 'store'])
        ->name('evaluaciones.psicologia.store');

    // RADIOGRAFIA
    Route::get('/evaluaciones/{evaluacion}/radiografia/editar', [RadiografiaController::class, 'edit'])
        ->name('evaluaciones.radiografia.edit');
    Route::post('/evaluaciones/{evaluacion}/radiografia', [RadiografiaController::class, 'store'])
        ->name('evaluaciones.radiografia.store');
    // PDF RADIOGRAFIA
    Route::get(
        '/evaluacion/{evaluacion}/radiografia/pdf',
        [RadiografiaController::class, 'pdf']
    )->name('radiografia.pdf');




    /* EMPRESAS — SOLO ADMINISTRADOR y RECEPCIÓN */
    Route::middleware('role:ADMINISTRADOR,RECEPCION')->group(function () {

        Route::get('/empresa', [EmpresaController::class, 'index'])->name('empresa');
        Route::get('/empresa/crear', [EmpresaController::class, 'create'])->name('empresa.crear');
        Route::post('/empresa', [EmpresaController::class, 'store'])->name('empresa.store');
        Route::get('/empresa/{empresa}/editar', [EmpresaController::class, 'edit'])->name('empresa.editar');
        Route::put('/empresa/{empresa}', [EmpresaController::class, 'update'])->name('empresa.update');
        Route::get('/empresas/listado', [EmpresaController::class, 'listado']);
    });


    /*

    | MANTENIMIENTO — SOLO ADMINISTRADOR

    */
    Route::middleware('role:ADMINISTRADOR')->group(function () {

        // Vista principal de mantenimiento
        Route::get('/mantenimiento', [MantenimientoController::class, 'index'])->name('mantenimiento');

        // Especialidades
        Route::prefix('ocupacional/mantenimiento')->group(function () {

            Route::get('/especialidades', [EspecialidadOcupacionalController::class, 'index'])
                ->name('ocupacional.mantenimiento.especialidades.index');

            Route::post('/especialidades', [EspecialidadOcupacionalController::class, 'store'])
                ->name('ocupacional.mantenimiento.especialidades.store');

            Route::put('/especialidades/{especialidad}', [EspecialidadOcupacionalController::class, 'update'])
                ->name('ocupacional.mantenimiento.especialidades.update');

            Route::delete('/especialidades/{especialidad}', [EspecialidadOcupacionalController::class, 'destroy'])
                ->name('ocupacional.mantenimiento.especialidades.destroy');


            // Personal
            Route::prefix('personal')->name('ocupacional.mantenimiento.personal.')->group(function () {
                Route::get('/', [PersonalController::class, 'index'])->name('index');
                Route::post('/', [PersonalController::class, 'store'])->name('store');
                Route::put('/{personal}', [PersonalController::class, 'update'])->name('update');
                Route::delete('/{personal}', [PersonalController::class, 'destroy'])->name('destroy');
            });

            // Roles
            Route::get('roles', [RolesController::class, 'index'])->name('ocupacional.mantenimiento.roles.index');
            Route::post('roles', [RolesController::class, 'store'])->name('ocupacional.mantenimiento.roles.store');
            Route::put('roles/{rol}', [RolesController::class, 'update'])->name('ocupacional.mantenimiento.roles.update');
            Route::delete('roles/{rol}', [RolesController::class, 'destroy'])->name('ocupacional.mantenimiento.roles.destroy');

            // Usuarios
            Route::get('usuarios', [UsuariosController::class, 'index'])->name('ocupacional.mantenimiento.usuarios.index');
            Route::post('usuarios', [UsuariosController::class, 'store'])->name('ocupacional.mantenimiento.usuarios.store');
            Route::put('usuarios/{user}', [UsuariosController::class, 'update'])->name('ocupacional.mantenimiento.usuarios.update');
            Route::delete('usuarios/{user}', [UsuariosController::class, 'destroy'])->name('ocupacional.mantenimiento.usuarios.destroy');

            // Áreas
            Route::prefix('areas')->name('areas.')->group(function () {
                Route::get('/', [AreaOcupacionalController::class, 'index'])->name('index');
                Route::post('/', [AreaOcupacionalController::class, 'store'])->name('store');
                Route::put('/{area}', [AreaOcupacionalController::class, 'update'])->name('update');
                Route::delete('/{area}', [AreaOcupacionalController::class, 'destroy'])->name('destroy');
            });
        });
    });


    /*

    | Perfil (TODOS)

    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    | Rutas adicionales
    */
    Route::get(
        '/verificar-dni/{dni}',
        fn($dni) =>
        response()->json(Personal::where('dni', $dni)->exists())
    );
    // 
    Route::get('/ruta/{id}/progreso', [RutaMedicaController::class, 'progreso'])->name('ruta.progreso');



    Route::get('/verificar-dni-editar/{dni}/{id}', [PersonalController::class, 'verificarDniEditar']);
    Route::get('/verificar-usuario/{name}/{password}', [UsuariosController::class, 'verificarUsuario']);

    Route::get('/en-construccion', function () {
        return view('pagina_en_construccion');
    })->name('en.construccion');
});


/*
| Auth (Fortify / Breeze)
*/
require __DIR__ . '/auth.php';

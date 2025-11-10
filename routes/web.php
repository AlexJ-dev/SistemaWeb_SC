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
use App\Models\Personal;
use App\Http\Controllers\AntecedentesFamiliaresController;
use App\Http\Controllers\AntecedentesMedicosController;

// Redirección inicial al login
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('inicio')
        : redirect()->route('login');
});



// Rutas de login protegidas por middleware 'guest'
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login.store');

// Logout con invalidación de sesión
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');
    Route::get('/pacientes', [PacienteController::class, 'index'])->name('pacientes');
    // Ruta médica
    Route::get('/ruta-medica/crear', [RutaMedicaController::class, 'create'])->name('ruta.crear');
    Route::post('/ruta-medica', [RutaMedicaController::class, 'store'])->name('ruta.store');
    Route::get('/ruta-medica/{dni}', [RutaMedicaController::class, 'ver'])->name('ruta.ver');
    Route::get('/verificar-paciente/{dni}', [RutaMedicaController::class, 'verificarPaciente'])->name('ruta.verificar');


    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Mantenimiento -> Especialidades Ocupacionales
    Route::get('/especialidades', [EspecialidadOcupacionalController::class, 'index'])
        ->name('ocupacional.mantenimiento.especialidades.index');
    Route::post('/especialidades', [EspecialidadOcupacionalController::class, 'store'])
        ->name('ocupacional.mantenimiento.especialidades.store');
    Route::put('/especialidades/{especialidad}', [EspecialidadOcupacionalController::class, 'update'])
        ->name('ocupacional.mantenimiento.especialidades.update');
    Route::delete('/especialidades/{especialidad}', [EspecialidadOcupacionalController::class, 'destroy'])
        ->name('ocupacional.mantenimiento.especialidades.destroy');

    Route::prefix('ocupacional/mantenimiento')->name('ocupacional.mantenimiento.')->group(function () {
        Route::prefix('personal')->name('personal.')->group(function () {
            Route::get('/', [PersonalController::class, 'index'])->name('index');
            Route::post('/', [PersonalController::class, 'store'])->name('store');
            Route::put('/{personal}', [PersonalController::class, 'update'])->name('update');
            Route::delete('/{personal}', [PersonalController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('ocupacional/mantenimiento')->name('ocupacional.mantenimiento.')->group(function () {
        Route::get('roles', [RolesController::class, 'index'])->name('roles.index');
        Route::post('roles', [RolesController::class, 'store'])->name('roles.store');
        Route::put('roles/{rol}', [RolesController::class, 'update'])->name('roles.update');
        Route::delete('roles/{rol}', [RolesController::class, 'destroy'])->name('roles.destroy');
    });


    Route::prefix('ocupacional/mantenimiento')->name('ocupacional.mantenimiento.')->group(function () {
        Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
        Route::post('usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');
        Route::put('usuarios/{user}', [UsuariosController::class, 'update'])->name('usuarios.update');
        Route::delete('usuarios/{user}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
    });


    Route::prefix('ocupacional/mantenimiento')->name('areas.')->group(function () {
        Route::get('/areas', [AreaOcupacionalController::class, 'index'])->name('index');
        Route::post('/areas', [AreaOcupacionalController::class, 'store'])->name('store');
        Route::put('/areas/{area}', [AreaOcupacionalController::class, 'update'])->name('update');
        Route::delete('/areas/{area}', [AreaOcupacionalController::class, 'destroy'])->name('destroy');
    });


    // Historia Clínica + Antecedentes Médicos + Familiares (unificados)
    Route::get('/historia/{dni}/editar', [HistoriaClinicaController::class, 'editar'])->name('historiaClinica.editar');
    Route::post('/historia/{dni}/actualizar', [HistoriaClinicaController::class, 'actualizar'])->name('historiaClinica.actualizar');

    // Vistas clínicas
    Route::view('/ficha', 'ocupacional.ficha')->name('ficha.ocupacional');
    Route::view('/evaluaciones', 'ocupacional.evaluaciones')->name('evaluaciones');
    Route::view('/empresa', 'ocupacional.empresa')->name('empresa');
    Route::view('/correos', 'ocupacional.correos')->name('correos');
    Route::get('/mantenimiento', [MantenimientoController::class, 'index'])->name('mantenimiento');
});
Route::get('/verificar-dni/{dni}', function ($dni) {
    return response()->json(Personal::where('dni', $dni)->exists());
});
Route::get('/verificar-dni-editar/{dni}/{id}', [PersonalController::class, 'verificarDniEditar']);

Route::get('/verificar-usuario/{name}/{password}', [UsuariosController::class, 'verificarUsuario']);


// Rutas de autenticación generadas por Breeze/Fortify
require __DIR__ . '/auth.php';

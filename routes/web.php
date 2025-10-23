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

    // Ruta médica
    Route::post('/ruta-medica', [RutaMedicaController::class, 'store'])->name('ruta.store');
    Route::get('/ruta-medica/{dni}', [RutaMedicaController::class, 'ver'])->name('ruta.ver');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pacientes
    Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store');
    Route::get('/pacientes/crear', [PacienteController::class, 'create'])->name('pacientes.crear');
    Route::view('/pacientes', 'ocupacional.pacientes')->name('pacientes');

    //Mantenimiento -> Especialidades Ocupacionales
    Route::get('/especialidades', [EspecialidadOcupacionalController::class, 'index'])
        ->name('ocupacional.mantenimiento.especialidades.index');
    Route::post('/especialidades', [EspecialidadOcupacionalController::class, 'store'])
        ->name('ocupacional.mantenimiento.especialidades.store');
    Route::put('/especialidades/{especialidad}', [EspecialidadOcupacionalController::class, 'update'])
        ->name('ocupacional.mantenimiento.especialidades.update');
    Route::delete('/especialidades/{especialidad}', [EspecialidadOcupacionalController::class, 'destroy'])
        ->name('ocupacional.mantenimiento.especialidades.destroy');




    // Vistas clínicas
    Route::view('/ficha', 'ocupacional.ficha')->name('ficha.ocupacional');
    Route::view('/evaluaciones', 'ocupacional.evaluaciones')->name('evaluaciones');
    Route::view('/empresa', 'ocupacional.empresa')->name('empresa');
    Route::view('/correos', 'ocupacional.correos')->name('correos');
    Route::get('/mantenimiento', [MantenimientoController::class, 'index'])->name('mantenimiento');
});

// Rutas de autenticación generadas por Breeze/Fortify
require __DIR__ . '/auth.php';

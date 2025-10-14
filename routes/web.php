<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InicioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PacienteController;


/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', function () {
    return redirect()->route('login');
});




Route::middleware('auth')->group(function () {
    Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store');
Route::view('/pacientes', 'ocupacional.pacientes')->name('pacientes');
Route::view('/ficha', 'ocupacional.ficha')->name('ficha.ocupacional');
Route::view('/evaluaciones', 'ocupacional.evaluaciones')->name('evaluaciones');
Route::view('/empresa', 'ocupacional.empresa')->name('empresa');
Route::view('/correos', 'ocupacional.correos')->name('correos');
Route::get('/pacientes/crear', [PacienteController::class, 'create'])->name('pacientes.crear');


require __DIR__.'/auth.php';

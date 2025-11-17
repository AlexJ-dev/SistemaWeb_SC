<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\RutaMedica;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    public function index()
{
    // Traemos las rutas médicas con evaluaciones y paciente
    $rutas = RutaMedica::with(['evaluaciones', 'paciente'])
        ->orderBy('registrado_en', 'desc')
        ->get();

    return view('ocupacional.pacientes', compact('rutas'));
}


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RutaMedica;
use Illuminate\Support\Facades\Auth;

class RutaMedicaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required|numeric',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'tipo_documento' => 'required|string',
            'empresa' => 'required|string',
            'cargo' => 'required|string',
            'tipo_evaluacion' => 'required|string',
        ]);

        RutaMedica::create([
            'documento' => $request->documento,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'tipo_documento' => $request->tipo_documento,
            'empresa' => $request->empresa,
            'cargo' => $request->cargo,
            'tipo_evaluacion' => $request->tipo_evaluacion,
            'registrado_por' => Auth::user()->username ?? 'admin',
            'registrado_en' => now(),
        ]);

        return redirect()->route('inicio')->with('success', 'Paciente registrado en ruta médica.');
    }
}


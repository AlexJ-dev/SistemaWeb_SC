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
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'documento' => 'required|numeric',
            'tipo_documento' => 'required|string',
            'empresa' => 'required|string',
            'cargo' => 'required|string',
            'tipo_evaluacion' => 'required|string',
        ]);

        RutaMedica::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'documento' => $request->documento,
            'tipo_documento' => $request->tipo_documento,
            'empresa' => $request->empresa,
            'cargo' => $request->cargo,
            'tipo_evaluacion' => $request->tipo_evaluacion,
            'registrado_por' => Auth::check() ? Auth::user()->name : 'admin',
            'registrado_en' => now(),
        ]);

        return redirect()->route('inicio')->with('success', 'Paciente registrado en ruta médica.');
    }
    public function ver($dni)
    {
        $ruta = RutaMedica::where('documento', $dni)->latest()->first();

        if (!$ruta) {
            return redirect()->back()->with('error', 'No se encontró hoja de ruta para este DNI.');
        }

        return view('ocupacional.ruta.ver', compact('ruta'));
    }
}

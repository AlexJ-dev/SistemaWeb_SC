<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\FichaOcupacional;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::orderBy('apellidos')->get();
        return view('ocupacional.pacientes', compact('pacientes'));
    }

    public function store(Request $request)
    {
        // Validación básica
        $request->validate([
            'documento' => 'required|numeric',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'tipo_documento' => 'required|string',
            'tipo_evaluacion' => 'required|string',
            'empresa' => 'required|string',
            'puesto_actual' => 'nullable|string',
        ]);

        // Buscar o crear paciente por DNI
        $paciente = Paciente::firstOrCreate(
            ['documento' => $request->documento],
            [
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'tipo_documento' => $request->tipo_documento,
            ]
        );

        // Registrar ficha ocupacional inicial
        FichaOcupacional::updateOrCreate(
            ['paciente_id' => $paciente->id],
            [
                'tipo_evaluacion' => $request->tipo_evaluacion,
                'empresa' => $request->empresa,
                'puesto_actual' => $request->puesto_actual,
                'contratista' => $request->contratista,
                'puesto_postula' => $request->puesto_postula,
                'tiempo_puesto_actual' => $request->tiempo_puesto_actual,
                'explora_superficie' => $request->has('explora_superficie'),
                'explora_concentradora' => $request->has('explora_concentradora'),
                'explora_subsuelo' => $request->has('explora_subsuelo'),
                'altitud' => $request->altitud,
            ]
        );

        return redirect()->route('inicio')->with('success', 'Paciente y ficha ocupacional registrados correctamente.');
    }
}

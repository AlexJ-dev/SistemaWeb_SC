<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluacion;
use App\Models\EvaluacionTriaje;

class TriajeController extends Controller
{
    public function store(Request $request, $evaluacionId)
    {
        $validated = $request->validate([
            'talla' => 'nullable|numeric',
            'peso' => 'nullable|numeric',
            'indice_masa_corporal' => 'nullable|numeric',
            'frecuencia_respiratoria' => 'nullable|integer',
            'frecuencia_cardiaca' => 'nullable|integer',
            'saturacion_oxigeno' => 'nullable|integer',
            'presion_arterial' => 'nullable|string',
            'temperatura' => 'nullable|numeric',
            'perimetro_toracico' => 'nullable|numeric',
            'perimetro_abdominal' => 'nullable|numeric',
            'cintura' => 'nullable|numeric',
            'cadera' => 'nullable|numeric',
            'indice_cintura_cadera' => 'nullable|numeric',
            'anamnesis' => 'nullable|string',
            'ectoscopia' => 'nullable|string',
            'estado_mental' => 'nullable|string',
        ]);

        EvaluacionTriaje::updateOrCreate(
            ['evaluacion_id' => $evaluacionId],
            $validated
        );

        return redirect()->back()->with('success', 'Triaje registrado correctamente.');
    }

    public function edit($evaluacionId)
    {
        $evaluacion = Evaluacion::findOrFail($evaluacionId);
        $triaje = EvaluacionTriaje::where('evaluacion_id', $evaluacionId)->first();

        return view('ocupacional.evaluaciones.triaje', compact('evaluacion', 'triaje'));
    }
}

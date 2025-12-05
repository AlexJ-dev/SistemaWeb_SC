<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\EvaluacionPsicologia;
use Illuminate\Http\Request;

class PsicologiaController extends Controller
{
    /**
     * Mostrar el formulario de psicología
     */
    public function show(Evaluacion $evaluacion)
    {
        return view('ocupacional.evaluaciones.psicologia', [
            'evaluacion' => $evaluacion,
            'psicologia' => $evaluacion->psicologia
        ]);
    }

    /**
     * Guardar o actualizar la evaluación de psicología
     */
    public function store(Request $request, Evaluacion $evaluacion)
    {
        $data = $request->validate([
            'presentacion' => 'nullable|string',
            'postura' => 'nullable|string',
            'discurso_ritmo' => 'nullable|string',
            'discurso_tono' => 'nullable|string',
            'discurso_articulacion' => 'nullable|string',
            'orientacion_tiempo' => 'nullable|boolean',
            'orientacion_espacio' => 'nullable|boolean',
            'orientacion_persona' => 'nullable|boolean',
            'nivel_intelectual' => 'nullable|string',
            'coordinacion_visomotriz' => 'nullable|string',
            'nivel_memoria' => 'nullable|string',
            'personalidad' => 'nullable|string',
            'medividad' => 'nullable|string',
            'altura' => 'nullable|string',
            'estres' => 'nullable|boolean',
            'ansiedad' => 'nullable|boolean',
            'depresion' => 'nullable|boolean',
            'fatiga' => 'nullable|boolean',
            'somnolencia' => 'nullable|boolean',
            'espacios_confinados' => 'nullable|boolean',
            'fobias' => 'nullable|boolean',
            'minisiquiatrico' => 'nullable|string',
            'audit' => 'nullable|string',
            'conclusiones_area_congnitiva' => 'nullable|string',
            'conclusiones_area_emocional' => 'nullable|string',
            'recomendaciones' => 'nullable|string',
        ]);

        // Crear o actualizar la evaluación de psicología
        $evaluacion->psicologia()->updateOrCreate(
            ['evaluacion_id' => $evaluacion->id],
            $data
        );

        return redirect()->back()->with('success', 'Evaluación psicológica guardada correctamente.');
    }
}

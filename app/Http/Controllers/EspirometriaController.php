<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\EvaluacionEspirometria;
use Illuminate\Http\Request;

class EspirometriaController extends Controller
{

    /**
     * Guardar o actualizar la evaluación de espirometría
     */
    public function store(Request $request, $evaluacionId)
    {
        $validated = $request->validate([
            // Antecedentes
            'deprendimiento_retina' => 'nullable|boolean',
            'infarto_corazon' => 'nullable|boolean',
            'hopitalizado_problema_corazon' => 'nullable|boolean',
            'medicamentos_tuberculosis' => 'nullable|boolean',
            'embarazo_actual' => 'nullable|boolean',
            'diagnostico_covid' => 'nullable|boolean',
            'hemoptisis' => 'nullable|boolean',
            'pneumotrorax' => 'nullable|boolean',
            'traqueostomia' => 'nullable|boolean',
            'sonda_pleurral' => 'nullable|boolean',
            'aneurisma_celebral_abdomen_torax' => 'nullable|boolean',
            'embolia_pulmonar' => 'nullable|boolean',
            'infarto_reciente' => 'nullable|boolean',
            'inestabilidad_cv' => 'nullable|boolean',
            'fiebre_nauseas_vomitos' => 'nullable|boolean',
            'embarazo_avanzado' => 'nullable|boolean',
            'embarazo_complicado' => 'nullable|boolean',
            'amenaza_aborto' => 'nullable|boolean',
            'infeccion_respiratoria' => 'nullable|boolean',
            'infeccion_oido' => 'nullable|boolean',

            // Medicación y hábitos
            'nebulizadores_broncodilatadores' => 'nullable|boolean',
            'medicamento_broncodilatador' => 'nullable|boolean',
            'fumo_cigarrillos' => 'nullable|boolean',
            'cuantos_cigarrillos' => 'nullable|integer',
            'ejercicio_fisico' => 'nullable|boolean',
            'comio' => 'nullable|boolean',

            // Especificaciones
            'especificaciones' => 'nullable|string',

            // Resultados
            'fvc_pre' => 'nullable|numeric',
            'fvc_ref_porcentaje' => 'nullable|numeric',
            'fvc_ref' => 'nullable|numeric',

            'fev1_pre' => 'nullable|numeric',
            'fev1_ref_porcentaje' => 'nullable|numeric',
            'fev1_ref' => 'nullable|numeric',

            'fev_fvc_pre' => 'nullable|numeric',
            'fev_fvc_ref_porcentaje' => 'nullable|numeric',
            'fev_fvc_ref' => 'nullable|numeric',

            'fef_pre' => 'nullable|numeric',
            'fef_ref_porcentaje' => 'nullable|numeric',
            'fef_ref' => 'nullable|numeric',
        ]);

        // Crear o actualizar la evaluación de espirometría
        EvaluacionEspirometria::updateOrCreate(
            ['evaluacion_id' => $evaluacionId],
            $validated
        );

        return redirect()->back()->with('success', 'Evaluación de espirometría guardada correctamente.');
    }
    public function edit($evaluacionId)
    {
        $evaluacion = Evaluacion::findOrFail($evaluacionId);
        $espirometria = EvaluacionEspirometria::where('evaluacion_id', $evaluacionId)->first();

        return view('ocupacional.evaluaciones.espirometria', compact('evaluacion', 'espirometria'));
    }
}

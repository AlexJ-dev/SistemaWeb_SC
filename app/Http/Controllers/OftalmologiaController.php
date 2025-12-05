<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\EvaluacionOftalmologia;
use Illuminate\Http\Request;

class OftalmologiaController extends Controller
{
    

    public function store(Request $request, $evaluacionId)
    {
        $validated = $request->validate([
            'hta' => 'nullable|boolean',
            'diabetes_mellitus' => 'nullable|boolean',
            'glaucoma' => 'nullable|boolean',
            'estrabismo' => 'nullable|boolean',
            'conjuntivitis' => 'nullable|boolean',
            'traumatismo' => 'nullable|boolean',
            'radiaciones' => 'nullable|boolean',
            'quimicos' => 'nullable|boolean',
            'exposicion_computadoras' => 'nullable|boolean',
            'prurito' => 'nullable|boolean',
            'vision_borrosa' => 'nullable|boolean',
            'cefalea' => 'nullable|boolean',
            'otros' => 'nullable|string',
            'lentes' => 'nullable|boolean',
            'parpados_anexos' => 'nullable|string',
            'polo_anterior' => 'nullable|string',
            'reflejo_pupilar' => 'nullable|string',
            'test_ishihara' => 'nullable|boolean',
            'vision_nocturna' => 'nullable|boolean',
            'vision_colores' => 'nullable|boolean',
            'vision_profundidad' => 'nullable|boolean',
            'av_lejos_sin_corrector_izq' => 'nullable|string',
            'av_lejos_con_corrector_izq' => 'nullable|string',
            'av_cerca_sin_corrector_izq' => 'nullable|string',
            'av_cerca_con_corrector_izq' => 'nullable|string',
            'av_lejos_sin_corrector_der' => 'nullable|string',
            'av_lejos_con_corrector_der' => 'nullable|string',
            'av_cerca_sin_corrector_der' => 'nullable|string',
            'av_cerca_con_corrector_der' => 'nullable|string',
            'sensibilidad_mucosa' => 'nullable|string',
            'diagnostico' => 'nullable|string',
            'recomendaciones' => 'nullable|string',
        ]);
       

        EvaluacionOftalmologia::updateOrCreate(
            ['evaluacion_id' => $evaluacionId],
            $validated
        );
        return redirect()->back()->with('success', 'Evaluación oftalmológica guardada correctamente.');
    }

    public function edit($evaluacionId)
    {
        $evaluacion = Evaluacion::findOrFail($evaluacionId);
        $oftalmologia = EvaluacionOftalmologia::where('evaluacion_id', $evaluacionId)->first();

        return view('ocupacional.evaluaciones.oftalmologia', compact('evaluacion', 'oftalmologia'));
    }
}

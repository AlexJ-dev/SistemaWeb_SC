<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\EvaluacionAudiometria;
use Illuminate\Http\Request;

class AudiometriaController extends Controller
{

    /**
     * Guardar o actualizar la evaluación de audiometría
     */
    public function store(Request $request, $evaluacionId)
    {
        $validated = $request->validate([
            'anios_trabajo' => 'nullable|integer',
            'tep' => 'nullable|string',
            'uso_tapones' => 'nullable|boolean',
            'uso_orejeras' => 'nullable|boolean',
            'apreciacion_ruido' => 'nullable|string',
            'cambio_altitud' => 'nullable|boolean',
            'exposicion_ruidos' => 'nullable|boolean',
            'malestar_oido_garganta' => 'nullable|boolean',
            'problema_dormir' => 'nullable|boolean',
            'consume_alcohol' => 'nullable|boolean',
            'uso_medicamentos' => 'nullable|boolean',
            'consume_tabaco' => 'nullable|boolean',
            'servicio_militar' => 'nullable|boolean',
            'hobbi_exposicion_ruido' => 'nullable|boolean',
            'exposicion_laboral_quimicos' => 'nullable|boolean',
            'infecciones_oido' => 'nullable|boolean',
            'uso_ototoxicos' => 'nullable|boolean',
            'disminucion_audicion' => 'nullable|boolean',
            'otalgia' => 'nullable|boolean',
            'zumbido' => 'nullable|boolean',
            'mareos' => 'nullable|boolean',
            'secrecion_oido' => 'nullable|boolean',
            'otros' => 'nullable|string',
            'otoscopia_oido_der' => 'nullable|string',
            'otoscopia_oido_izq' => 'nullable|string',
            'fre_oido_der_500' => 'nullable|string',
            'fre_oido_der_1000' => 'nullable|string',
            'fre_oido_der_2000' => 'nullable|string',
            'fre_oido_der_3000' => 'nullable|string',
            'fre_oido_der_4000' => 'nullable|string',
            'fre_oido_der_6000' => 'nullable|string',
            'fre_oido_der_8000' => 'nullable|string',
            'fre_oido_izq_500' => 'nullable|string',
            'fre_oido_izq_1000' => 'nullable|string',
            'fre_oido_izq_2000' => 'nullable|string',
            'fre_oido_izq_3000' => 'nullable|string',
            'fre_oido_izq_4000' => 'nullable|string',
            'fre_oido_izq_6000' => 'nullable|string',
            'fre_oido_izq_8000' => 'nullable|string',
            'practica_tiro' => 'nullable|boolean',
            'usa_auriculares' => 'nullable|boolean',
            'sordera_familiar' => 'nullable|boolean',
            'perdida_audio_der' => 'nullable|string',
            'perdida_audio_izq' => 'nullable|string',
        ]);

        EvaluacionAudiometria::updateOrCreate(
            ['evaluacion_id' => $evaluacionId],
            $validated
        );


        return redirect()->back()->with('success', 'Evaluación audiométrica guardada correctamente.');
    }
    public function edit($evaluacionId)
    {
        $evaluacion = Evaluacion::findOrFail($evaluacionId);
        $audiometria = EvaluacionAudiometria::where('evaluacion_id', $evaluacionId)->first();

        return view('ocupacional.evaluaciones.audiometria', compact('evaluacion', 'audiometria'));
    }
}

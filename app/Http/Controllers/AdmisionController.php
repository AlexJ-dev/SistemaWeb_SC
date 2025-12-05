<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluacion;


class AdmisionController extends Controller
{
    public function edit($evaluacionId)
    {
        $evaluacion = Evaluacion::with([
            'hojaRuta',
            'fichaOcupacional',
            'fichaMedica.historiaClinica',
            'historiaOcupacional'
        ])->findOrFail($evaluacionId);

        return view('ocupacional.evaluaciones.admision', compact('evaluacion'));
    }


    public function update(Request $request, $evaluacionId)
    {
        $evaluacion = Evaluacion::findOrFail($evaluacionId);

        // Ficha Ocupacional
        $evaluacion->fichaOcupacional()->updateOrCreate(
            ['evaluacion_id' => $evaluacionId],
            $request->only(['numero_ficha', 'empresa', 'cargo', 'area'])
        );

        

       

        // Historia Clínica (a través de Ficha Médica)
        $evaluacion->fichaMedica()->updateOrCreate(
            ['evaluacion_id' => $evaluacionId],
            ['historia_clinica_id' => $request->input('historia_clinica_id')]
        );

        return redirect()->back()->with('success', 'Datos de admisión actualizados correctamente.');
    }
}

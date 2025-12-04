<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluacion;
use App\Models\AreaOcupacional;
use App\Models\RutaMedica;
use Illuminate\Support\Facades\Auth;
use App\Models\FichaOcupacional;

class EvaluacionController extends Controller
{
    /**
     * Muestra la lista de áreas y los pacientes por área.
     */
    public function index(Request $request)
    {
        $areas = AreaOcupacional::with(['evaluaciones' => function ($q) {

            $q->where('no_aplica', false)
                ->whereNull('hora_salida')
                //  Solo evaluaciones de HOY
                ->whereHas('rutaMedica', function ($q3) {
                    $q3->whereDate('registrado_en', now()->toDateString());
                })
                ->with([
                    'rutaMedica' => function ($q2) {
                        $q2->select(
                            'id',
                            'nombres',
                            'apellidos',
                            'documento',
                            'tipo_evaluacion',
                            'empresa'
                        )
                            ->with('fichaOcupacional:id,ruta_medica_id,numero_ficha');
                    },
                    'areaOcupacional:id,nombre'
                ])
                ->select(
                    'id',
                    'ruta_medica_id',
                    'area_ocupacional_id',
                    'hora_ingreso',
                    'hora_salida',
                    'estado',
                    'no_aplica'
                );
        }])->get();


        $areaSeleccionada = $request->get('area_id');

        if ($areaSeleccionada) {
            $areas = $areas->where('id', $areaSeleccionada);
        }

        return view('ocupacional.evaluaciones', compact('areas', 'areaSeleccionada'));
    }





    public function ver($id)
    {
        $evaluacion = Evaluacion::with(['rutaMedica', 'area'])->findOrFail($id);

        return view('ocupacional.evaluaciones.ver', compact('evaluacion'));
    }

    /**
     * Actualizar los datos de una evaluación (por ejemplo: observaciones, estado, horas, etc.).
     */
    public function actualizar(Request $request, $id)
    {
        $evaluacion = Evaluacion::findOrFail($id);

        $evaluacion->update([
            'hora_ingreso'   => $request->hora_ingreso ?? $evaluacion->hora_ingreso,
            'hora_salida'    => $request->hora_salida ?? $evaluacion->hora_salida,
            'observaciones'  => $request->observaciones ?? $evaluacion->observaciones,
            'estado'         => $request->estado ?? $evaluacion->estado,
            'user_id'        => Auth::id(),
            'no_aplica'      => $request->has('no_aplica') ? 1 : 0,
        ]);

        return back()->with('success', 'Evaluación actualizada correctamente.');
    }

    /**
     * Marcar una evaluación como completada.
     */
    public function completar($id)
    {
        $evaluacion = Evaluacion::findOrFail($id);
        $evaluacion->update([
            'estado' => 'completada',
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Evaluación marcada como completada.');
    }
    public function iniciarEvaluacion($id)
    {
        $evaluacion = Evaluacion::findOrFail($id);

        if (!$evaluacion->hora_ingreso) {
            $evaluacion->hora_ingreso = now();
            $evaluacion->user_id = Auth::id();
            $evaluacion->estado = 'iniciada'; // 🔹 en vez de 'pendiente'
            $evaluacion->save();
        }

        return response()->json([
            'success' => true,
            'hora_ingreso' => $evaluacion->hora_ingreso->format('H:i:s'),
        ]);
    }

    public function finalizarEvaluacion($id)
    {
        $evaluacion = Evaluacion::findOrFail($id);

        if ($evaluacion->hora_ingreso && !$evaluacion->hora_salida) {
            $evaluacion->hora_salida = now();
            $evaluacion->estado = 'completada';
            $evaluacion->user_id = Auth::id();
            $evaluacion->save();
        }

        // ==============================
        //  🔥 NUEVO: VERIFICAR SI YA TERMINÓ TODA LA RUTA
        // ==============================
        $ruta = $evaluacion->rutaMedica;

        $pendientes = Evaluacion::where('ruta_medica_id', $ruta->id)
            ->whereNull('hora_salida')
            ->where('no_aplica', false)
            ->count();

        if ($pendientes === 0) {
            $ruta->estado = 'finalizado';
            $ruta->fecha_salida = now();
            $ruta->save();
        }
        // ==============================

        return response()->json([
            'success' => true,
            'hora_salida' => $evaluacion->hora_salida->format('H:i:s'),
        ]);
    }

    public function continuar($rutaId)
{
    $ruta = RutaMedica::findOrFail($rutaId);

    // traer solo evaluaciones pendientes de esa ruta
    $areas = AreaOcupacional::with(['evaluaciones' => function ($q) use ($rutaId) {
        $q->where('ruta_medica_id', $rutaId)
            ->where('no_aplica', false)
            ->whereNull('hora_salida') // 🔥 solo pendientes
            ->with(['rutaMedica', 'areaOcupacional'])
            ->select(
                'id',
                'ruta_medica_id',
                'area_ocupacional_id',
                'hora_ingreso',
                'hora_salida',
                'estado',
                'no_aplica'
            );
    }])->get();

    return view('ocupacional.evaluaciones', [
        'areas' => $areas,
        'areaSeleccionada' => null,
        'rutaSeleccionada' => $ruta
    ]);
}

}

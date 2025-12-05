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
        // Verificar si el usuario ya tiene una evaluación activa
        $evaluacionActiva = Evaluacion::where('user_id', Auth::id())
            ->whereNotNull('hora_ingreso')
            ->whereNull('hora_salida')
            ->first();

        if ($evaluacionActiva) {
            return response()->json([
                'success' => false,
                'message' => 'Ya tienes una evaluación activa. Finalízala antes de iniciar otra.'
            ], 400);
        }

        $evaluacion = Evaluacion::findOrFail($id);

        if (!$evaluacion->hora_ingreso) {
            $evaluacion->hora_ingreso = now();
            $evaluacion->user_id = Auth::id();
            $evaluacion->estado = 'iniciada';
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
                ->whereNull('hora_salida') //  solo pendientes
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

    public function show($id)
    {
        $eval = Evaluacion::with(['rutaMedica', 'rutaMedica.fichaOcupacional'])
            ->findOrFail($id);

        return view('evaluaciones.show', [
            'evaluacion' => $eval,
            'area' => $eval->area_ocupacional_id,
        ]);
    }
    public function reiniciarEvaluacion($id)
    {
        $evaluacion = Evaluacion::findOrFail($id);

        // Solo permitir reinicio si está iniciada pero no finalizada
        if ($evaluacion->hora_ingreso && !$evaluacion->hora_salida) {
            $evaluacion->hora_ingreso = null;
            $evaluacion->user_id = null;
            $evaluacion->estado = 'pendiente'; // o el estado inicial que uses
            $evaluacion->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Evaluación reiniciada correctamente'
        ]);
    }

    public function editar($id)
    {
        $evaluacion = Evaluacion::with('areaOcupacional')->findOrFail($id);

        switch ($evaluacion->area_ocupacional_id) {
            case 3: // TRIAJE
                return redirect()->route('triaje.edit', $evaluacion->id);

            case 5: // OFTALMOLOGIA
                return redirect()->route('evaluaciones.oftalmologia.edit', $evaluacion->id);

            case 6: // AUDIOMETRIA
                return redirect()->route('evaluaciones.audiometria.edit', $evaluacion->id);

            case 7: // ESPIROMETRIA
                return redirect()->route('evaluaciones.espirometria.edit', $evaluacion->id);

            case 8: // RADIOGRAFIA
                return redirect()->route('evaluaciones.radiografia.edit', $evaluacion->id);

            case 9: // PSICOLOGIA
                return redirect()->route('evaluaciones.psicologia.edit', $evaluacion->id);

            default:
                return redirect()->back()->with('error', 'Área ocupacional no reconocida o aún no implementada.');
        }
    }
}

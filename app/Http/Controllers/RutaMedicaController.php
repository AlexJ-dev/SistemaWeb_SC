<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RutaMedica;
use App\Models\AreaOcupacional;
use App\Models\Paciente;
use App\Models\HistoriaClinica;
use App\Models\Evaluacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa;
use Illuminate\Support\Facades\Log;


class RutaMedicaController extends Controller
{
    public function create()
    {
        $empresas = Empresa::all();
        return view('ocupacional.ruta.crear', compact('empresas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'documento' => 'required|string|max:50',
            'tipo_documento' => 'required|string',
            'empresa' => 'required|string',
            'cargo' => 'required|string',
            'tipo_evaluacion' => 'required|string',
        ]);

        $existeHoy = RutaMedica::where('documento', $request->documento)
            ->whereDate('registrado_en', now()->toDateString())
            ->exists();

        if ($existeHoy) {
            return back()
                ->with('error', 'El paciente ya tiene una ruta médica registrada hoy.')
                ->withInput();
        }

        // Buscar o crear paciente
        $paciente = Paciente::where('documento', $request->documento)->first();

        if (!$paciente) {
            $paciente = Paciente::create([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'documento' => $request->documento,
                'tipo_documento' => $request->tipo_documento,
                'fecha_nacimiento' => null,
                'sexo' => null,
                'telefono' => null,
                'correo_electronico' => null,
                'fecha' => now(),
            ]);

            // Crear historia clínica vacía
            HistoriaClinica::create([
                'paciente_id' => $paciente->id,
                'numero_historia' => 'HC-' . str_pad($paciente->id, 6, '0', STR_PAD_LEFT),
                'creado_por' => Auth::check() ? Auth::user()->name : 'admin',
                'creado_en' => now(),
            ]);
        } else {
            // Si existe paciente, opcional: actualizar nombres/apellidos si han cambiado
            $paciente->update([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
            ]);
        }


        // Buscar o crear historia clínica
        HistoriaClinica::firstOrCreate(
            ['paciente_id' => $paciente->id],
            [
                'numero_historia' => 'HC-' . str_pad($paciente->id, 6, '0', STR_PAD_LEFT),
                'creado_por' => Auth::check() ? Auth::user()->name : 'admin',
                'creado_en' => now(),
            ]
        );

        // Registrar hoja de ruta médica
        $ruta = RutaMedica::where('documento', $request->documento)
            ->where('estado', 'pendiente')
            ->whereDate('registrado_en', now()->toDateString())
            ->first();


        if (!$ruta) {
            // Crear nueva ruta
            $ruta = RutaMedica::create([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'documento' => $request->documento,
                'tipo_documento' => $request->tipo_documento,
                'empresa' => $request->empresa,
                'cargo' => $request->cargo,
                'tipo_evaluacion' => $request->tipo_evaluacion,
                'registrado_por' => Auth::check() ? Auth::user()->name : 'admin',
                'registrado_en' => now(),
                'estado' => 'pendiente',
            ]);

            // Crear evaluaciones para la ruta
            $areas = AreaOcupacional::all();
            foreach ($areas as $area) {
                Evaluacion::create([
                    'ruta_medica_id' => $ruta->id,
                    'area_ocupacional_id' => $area->id,
                    'estado' => 'pendiente',
                    'no_aplica' => false,
                ]);
            }
        }



        return redirect()->route('inicio')->with('success', 'Paciente registrado en ruta médica.');
    }

    public function ver($id)
    {
        $ruta = RutaMedica::find($id);
        $areasOcupacionales = AreaOcupacional::all();

        if (!$ruta) {
            return redirect()->back()->with('error', 'No se encontró la hoja de ruta.');
        }

        $evaluaciones = Evaluacion::with('areaOcupacional')
            ->where('ruta_medica_id', $ruta->id)
            ->get();

        return view('ocupacional.ruta.ver', compact('ruta', 'evaluaciones', 'areasOcupacionales'));
    }

    public function verificarPaciente($dni)
    {
        $paciente = Paciente::with('historiaClinica')->where('documento', $dni)->first();

        if ($paciente) {
            return response()->json([
                'existe' => true,
                'paciente' => [
                    'nombres' => $paciente->nombres,
                    'apellidos' => $paciente->apellidos,
                    'empresa' => $paciente->empresa,
                    'cargo' => $paciente->cargo,
                    'tipo_documento' => $paciente->tipo_documento,
                ],
                'historia' => $paciente->historiaClinica ? [
                    'numero_historia' => $paciente->historiaClinica->numero_historia,
                ] : null
            ]);
        }

        return response()->json(['existe' => false]);
    }

    public function guardarEvaluaciones(Request $request, $rutaId)
    {
        $evaluaciones = Evaluacion::where('ruta_medica_id', $rutaId)->get();

        foreach ($evaluaciones as $eval) {

            $areaId = $eval->area_ocupacional_id;

            $horaIngreso = $request->hora_ingreso[$areaId] ?? null;
            $horaSalida  = $request->hora_salida[$areaId] ?? null;

            // NORMALIZAR STRINGS VACÍOS A NULL
            $horaIngreso = $horaIngreso ? trim($horaIngreso) : null;
            $horaSalida  = $horaSalida ? trim($horaSalida) : null;

            // ---- 1. SI ES NO APLICA ----
            if (isset($request->no_aplica[$areaId])) {

                $eval->no_aplica = true;
                $eval->estado = 'no_aplica';
                $eval->hora_ingreso = null;
                $eval->hora_salida = null;
                $eval->observaciones = null;
                $eval->user_id = null;
            } else {

                // ---- 2. SI ES EVALUACIÓN NORMAL ----
                $eval->no_aplica = false;

                $eval->hora_ingreso = $horaIngreso ? now()->format('Y-m-d') . ' ' . $horaIngreso . ':00' : null;
                $eval->hora_salida  = $horaSalida ?  now()->format('Y-m-d') . ' ' . $horaSalida . ':00' : null;
                $eval->observaciones = $request->observaciones[$areaId] ?? null;

                // Registrar usuario solo si realmente hay actividad
                if (!$eval->user_id && ($horaIngreso || $horaSalida || $eval->observaciones)) {
                    $eval->user_id = Auth::id();
                }

                // ---- LOGICA CORRECTA DE ESTADO ----
                if ($eval->hora_ingreso && $eval->hora_salida) {
                    $eval->estado = 'completada';
                } else {
                    $eval->estado = 'pendiente';
                }
            }

            $eval->save();
        }

        return back()->with('success', 'Evaluaciones actualizadas correctamente.');
    }


    // Ejemplo en tu controlador
    public function mostrarEvaluaciones($id)
    {
        $ruta = RutaMedica::findOrFail($id);
        $areasOcupacionales = AreaOcupacional::all();

        // Traemos las evaluaciones asociadas a esa ruta
        $evaluaciones = Evaluacion::where('ruta_medica_id', $id)->get()->keyBy('area_ocupacional_id');

        return view('ruta.evaluaciones', compact('ruta', 'areasOcupacionales', 'evaluaciones'));
    }

    public function progreso($id)
    {
        $ruta = RutaMedica::findOrFail($id);

        // Recargar evaluaciones
        $ruta->load('evaluaciones');

        // 🔹 Solo contar las evaluaciones que sí aplican
        $evaluacionesValidas = $ruta->evaluaciones->where('estado', '!=', 'no_aplica');

        $total = $evaluacionesValidas->count();
        $completadas = $evaluacionesValidas->where('estado', 'completada')->count();

        // Si todas las válidas están completadas, actualizar estado de la ruta
        if ($total > 0 && $completadas === $total && $ruta->estado !== 'finalizado') {
            $ruta->estado = 'finalizado';
            $ruta->fecha_salida = now();
            $ruta->save();
        }

        return response()->json([
            'total'        => $total,                //ahora excluye las no_aplica
            'completadas'  => $completadas,
            'pendientes'   => $total - $completadas,
            'estado'       => $ruta->estado,
            'fecha_salida' => $ruta->fecha_salida
        ]);
    }
}

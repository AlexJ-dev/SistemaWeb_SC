<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RutaMedica;
use App\Models\AreaOcupacional;
use App\Models\Paciente;
use App\Models\HistoriaClinica;
use Illuminate\Support\Facades\Auth;

class RutaMedicaController extends Controller
{
    public function create()
    {
        return view('ocupacional.ruta.crear');
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
        RutaMedica::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'documento' => $request->documento,
            'tipo_documento' => $request->tipo_documento,
            'empresa' => $request->empresa,
            'cargo' => $request->cargo,
            'tipo_evaluacion' => $request->tipo_evaluacion,
            'registrado_por' => Auth::check() ? Auth::user()->name : 'admin',
            'registrado_en' => now(),
        ]);

        return redirect()->route('inicio')->with('success', 'Paciente registrado en ruta médica.');
    }

    public function ver($dni)
    {
        $ruta = RutaMedica::where('documento', $dni)->latest()->first();
        $areasOcupacionales = AreaOcupacional::all();

        if (!$ruta) {
            return redirect()->back()->with('error', 'No se encontró hoja de ruta para este DNI.');
        }

        return view('ocupacional.ruta.ver', compact('ruta', 'areasOcupacionales'));
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
}

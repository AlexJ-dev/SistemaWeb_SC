<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\HistoriaOcupacional;
use Illuminate\Http\Request;

class HistoriaOcupacionalController extends Controller
{
    /**
     * Mostrar historial de un paciente
     */
    public function index($paciente_id)
    {
        $paciente = Paciente::findOrFail($paciente_id);

        $historial = HistoriaOcupacional::where('paciente_id', $paciente_id)
            ->orderBy('fecha_inicio', 'asc')
            ->get();

        return view('ocupacional.historia_ocupacional.historiaOcupacional', compact('paciente', 'historial'));
    }

    /**
     * Mostrar formulario para crear nuevo historial
     */
    public function crear($paciente_id)
    {
        $paciente = Paciente::findOrFail($paciente_id);

        return view('ocupacional.historia_ocupacional.partials.crear', compact('paciente'));
    }

    /**
     * Guardar nuevo historial ocupacional
     */
    public function store(Request $request, $paciente_id)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'empresa' => 'required|string|max:255',
            'ocupacion' => 'nullable|string|max:255',
            'actividad_realizada' => 'required|string|max:255',
            'area_trabajo' => 'nullable|string|max:255',
            'ubicacion_departamento' => 'nullable|string|max:255',
            'altura_snm' => 'nullable|numeric',
            'tiempo_subsuelo' => 'nullable|numeric',
            'tiempo_superficie' => 'nullable|numeric',
            'exposiciones_peligrosas' => 'nullable|string',
            'medidas_proteccion_ambiental' => 'nullable|string',
            'medidas_proteccion_personal' => 'nullable|string',
        ]);

        HistoriaOcupacional::create([
            'paciente_id' => $paciente_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'empresa' => $request->empresa,
            'ocupacion' => $request->ocupacion,
            'actividad_realizada' => $request->actividad_realizada,
            'area_trabajo' => $request->area_trabajo,
            'ubicacion_departamento' => $request->ubicacion_departamento,
            'altura_snm' => $request->altura_snm,
            'tiempo_subsuelo' => $request->tiempo_subsuelo,
            'tiempo_superficie' => $request->tiempo_superficie,
            'exposiciones_peligrosas' => $request->exposiciones_peligrosas,
            'medidas_proteccion_ambiental' => $request->medidas_proteccion_ambiental,
            'medidas_proteccion_personal' => $request->medidas_proteccion_personal,
        ]);

        return redirect()->route('historia.index', [
            'paciente_id' => $paciente_id,
            'from' => $request->from,
            'ficha' => $request->ficha
        ])->with('success', 'Historial registrado correctamente.');
    }


    /**
     * Mostrar formulario para editar
     */
    public function edit($id)
    {
        $historial = HistoriaOcupacional::findOrFail($id);
        $paciente = $historial->paciente;

        return view('ocupacional.historia_ocupacional.partials.editar', compact('historial', 'paciente'));
    }

    /**
     * Actualizar el historial ocupacional
     */
    public function update(Request $request, $id)
    {
        $historial = HistoriaOcupacional::findOrFail($id);

        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'empresa' => 'required|string|max:255',
            'ocupacion' => 'nullable|string|max:255',
            'actividad_realizada' => 'required|string|max:255',
            'area_trabajo' => 'nullable|string|max:255',
            'ubicacion_departamento' => 'nullable|string|max:255',
            'altura_snm' => 'nullable|numeric',
            'tiempo_subsuelo' => 'nullable|numeric',
            'tiempo_superficie' => 'nullable|numeric',
            'exposiciones_peligrosas' => 'nullable|string',
            'medidas_proteccion_ambiental' => 'nullable|string',
            'medidas_proteccion_personal' => 'nullable|string',
        ]);

        // Actualizar solo campos válidos
        $historial->update($request->only([
            'fecha_inicio',
            'fecha_fin',
            'empresa',
            'ocupacion',
            'actividad_realizada',
            'area_trabajo',
            'ubicacion_departamento',
            'altura_snm',
            'tiempo_subsuelo',
            'tiempo_superficie',
            'exposiciones_peligrosas',
            'medidas_proteccion_ambiental',
            'medidas_proteccion_personal',
        ]));

        return redirect()->route('historia.index', [
            'paciente_id' => $historial->paciente_id,
            'from' => $request->from,
            'ficha' => $request->ficha
        ])->with('success', 'Historial actualizado correctamente.');
    }


    /**
     * Eliminar un historial
     */
    public function destroy(Request $request, $id)
    {
        $historial = HistoriaOcupacional::findOrFail($id);
        $paciente_id = $historial->paciente_id;

        $historial->delete();

        return redirect()->route('historia.index', [
            'paciente_id' => $historial->paciente_id,
            'from' => $request->from,
            'ficha' => $request->ficha
        ])->with('success', 'Historial eliminado correctamente.');
    }
}

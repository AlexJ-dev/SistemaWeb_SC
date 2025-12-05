<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\HistoriaClinica;
use App\Models\AntecedentesMedicos;
use App\Models\AntecedentesFamiliares;
use App\Models\Enfermedad;
use Illuminate\Support\Facades\Auth;

class HistoriaClinicaController extends Controller
{
    /**
     * Mostrar formulario de historia clínica completa (historia + antecedentes).
     */
    public function editar($dni)
    {
        // Buscar paciente
        $paciente = Paciente::where('documento', $dni)->firstOrFail();

        // Buscar o crear historia clínica
        $historia = HistoriaClinica::firstOrCreate(
            ['paciente_id' => $paciente->id],
            [
                'numero_historia' => 'HC-' . str_pad($paciente->id, 6, '0', STR_PAD_LEFT),
                'creado_por' => Auth::user()->name ?? 'Sistema',
                'creado_en' => now(),
            ]
        );

        // Buscar o crear antecedentes médicos y familiares
        $antecedentesMedicos = AntecedentesMedicos::firstOrCreate(['historia_clinica_id' => $historia->id]);
        $antecedentesFamiliares = AntecedentesFamiliares::firstOrCreate(['historia_clinica_id' => $historia->id]);

        $enfermedades = Enfermedad::all();

        return view('ocupacional.historia.formulario', compact(
            'paciente',
            'historia',
            'antecedentesMedicos',
            'antecedentesFamiliares',
            'enfermedades'
        ));
    }

    /**
     * Guardar o actualizar toda la historia clínica (paciente + historia + antecedentes).
     */
    public function actualizar(Request $request, $dni)
    {
        // Validar campos básicos
        $request->validate([
            'paciente.documento' => 'required|string|max:50',
            'paciente.tipo_documento' => 'nullable|string|max:50',
            'paciente.nombres' => 'nullable|string|max:255',
            'paciente.apellidos' => 'nullable|string|max:255',
            'paciente.fecha_nacimiento' => 'nullable|date',
            'paciente.edad' => 'nullable|integer',
            'paciente.sexo' => 'nullable|string|max:10',
            'paciente.telefono' => 'nullable|string|max:50',
            'paciente.correo_electronico' => 'nullable|email|max:255',

            'historia.lugar_nacimiento_pais' => 'nullable|string|max:255',
            'historia.lugar_nacimiento_departamento' => 'nullable|string|max:255',
            'historia.lugar_nacimiento_provincia' => 'nullable|string|max:255',
            'historia.lugar_nacimiento_distrito' => 'nullable|string|max:255',
            'historia.domicilio_direccion' => 'nullable|string|max:255',
            'historia.domicilio_departamento' => 'nullable|string|max:255',
            'historia.domicilio_provincia' => 'nullable|string|max:255',
            'historia.domicilio_distrito' => 'nullable|string|max:255',
            'historia.estado_civil' => 'nullable|string|max:255',
            'historia.grado_institucional' => 'nullable|string|max:255',
            'historia.ocupacion' => 'nullable|string|max:255',
            'historia.religion' => 'nullable|string|max:255',
            'historia.seguro' => 'nullable|string|max:255',
            'historia.licencia_conducir' => 'nullable|string|max:255',
            'historia.emergencia_persona' => 'nullable|string|max:255',
            'historia.emergencia_direccion' => 'nullable|string|max:255',
            'historia.emergencia_parentesco' => 'nullable|string|max:255',
            'historia.emergencia_telefono' => 'nullable|string|max:50',
        ]);

        // Buscar historia con su paciente
        $historia = HistoriaClinica::whereHas('paciente', fn($q) => $q->where('documento', $dni))
            ->with('paciente')
            ->firstOrFail();

        // Actualizar datos del paciente
        $historia->paciente->update($request->input('paciente', []));

        // Actualizar datos generales de historia clínica (tomando los datos del array 'historia')
        $historia->update($request->input('historia', []));
        
        // Actualizar antecedentes médicos
        if ($request->has('antecedentes_medicos')) {
            $data = $request->input('antecedentes_medicos');

            // Guardar campos normales en la tabla antecedentes_medicos
            $antecedentesMedicos = AntecedentesMedicos::updateOrCreate(
                ['historia_clinica_id' => $historia->id],
                collect($data)->except('enfermedades')->toArray()
            );

            // Si vienen enfermedades seleccionadas, sincronizarlas en la tabla pivote
            if ($antecedentesMedicos && isset($data['enfermedades']) && is_array($data['enfermedades'])) {
                $antecedentesMedicos->enfermedades()->sync($data['enfermedades']);
            }
        }


        // Actualizar antecedentes familiares
        if ($request->has('antecedentes_familiares')) {
            AntecedentesFamiliares::updateOrCreate(
                ['historia_clinica_id' => $historia->id],
                $request->input('antecedentes_familiares')
            );
        }

        return redirect()
            ->back()
            ->with('success', 'Historia clínica y antecedentes actualizados correctamente.');
    }
}

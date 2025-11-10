<?php

namespace App\Http\Controllers;

use App\Models\HistoriaClinica;
use App\Models\AntecedentesMedicos;
use App\Models\Paciente;
use Illuminate\Http\Request;

class AntecedentesMedicosController extends Controller
{
    /**
     * Mostrar formulario en modo edición.
     * Si el registro no existe, se crea automáticamente.
     */
    public function editar($dni)
    {
        // Buscar paciente por DNI
        $paciente = Paciente::where('documento', $dni)->firstOrFail();

        // Buscar historia clínica del paciente
        $historia = HistoriaClinica::where('paciente_id', $paciente->id)->firstOrFail();

        // Buscar antecedentes médicos existentes
        $antecedente = AntecedentesMedicos::where('historia_clinica_id', $historia->id)->first();

        // Si no existe, crear uno vacío
        if (!$antecedente) {
            $antecedente = AntecedentesMedicos::create([
                'historia_clinica_id' => $historia->id,
                'patologicos_personales' => null,
                'cirugias' => null,
                'intoxicaciones' => null,
                'alergias' => null,
                'hospitalizaciones' => null,
                'medicamentos' => null,
                'inmunizaciones' => null,
                'habito_tabaco' => null,
                'habito_alcohol' => null,
                'habito_drogas' => null,
                'grupo_sanguineo' => null,
                'observaciones' => null,
            ]);
        }

        
        return view('ocupacional.historia.antecedentes-medicos', [
            'historia' => $historia,
            'antecedente' => $antecedente,
        ]);
    }

    /**
     * Actualizar antecedentes médicos.
     */
    public function actualizar(Request $request, $dni)
    {
        $paciente = Paciente::where('documento', $dni)->firstOrFail();
        $historia = HistoriaClinica::where('paciente_id', $paciente->id)->firstOrFail();
        $antecedente = AntecedentesMedicos::where('historia_clinica_id', $historia->id)->firstOrFail();

        $antecedente->update($request->only([
            'patologicos_personales',
            'cirugias',
            'intoxicaciones',
            'alergias',
            'hospitalizaciones',
            'medicamentos',
            'inmunizaciones',
            'habito_tabaco',
            'habito_alcohol',
            'habito_drogas',
            'grupo_sanguineo',
            'observaciones',
        ]));

        return redirect()
            ->route('antecedentesMedicos.editar', ['dni' => $dni])
            ->with('success', 'Antecedentes médicos actualizados correctamente.');
    }
}

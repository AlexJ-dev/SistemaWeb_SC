<?php

namespace App\Http\Controllers;

use App\Models\HistoriaClinica;
use App\Models\AntecedentesFamiliares;
use App\Models\Paciente;
use Illuminate\Http\Request;

class AntecedentesFamiliaresController extends Controller
{
    /**
     * Mostrar o crear antecedentes familiares (modo editar).
     */
    public function editar($dni)
    {
        // Buscar paciente por DNI
        $paciente = Paciente::where('documento', $dni)->firstOrFail();

        // Buscar historia clínica del paciente
        $historia = HistoriaClinica::where('paciente_id', $paciente->id)->firstOrFail();

        // Buscar antecedentes familiares o crear uno vacío si no existe
        $antecedente = AntecedentesFamiliares::firstOrCreate(
            ['historia_clinica_id' => $historia->id],
            [
                'numero_hijos_vivos' => null,
                'numero_hijos_muertos' => null,
                'salud_padre' => null,
                'observacion_padre' => null,
                'salud_madre' => null,
                'observacion_madre' => null,
                'salud_esposo' => null,
                'observacion_esposo' => null,
                'salud_hijos' => null,
                'observacion_hijos' => null,
                'numero_dependientes' => null,
            ]
        );

        return view('ocupacional.historia.antecedentes-familiares', [
            'historia' => $historia,
            'antecedente' => $antecedente,
        ]);
    }

    /**
     * Actualizar antecedentes familiares.
     */
    public function actualizar(Request $request, $dni)
    {
        $paciente = Paciente::where('documento', $dni)->firstOrFail();
        $historia = HistoriaClinica::where('paciente_id', $paciente->id)->firstOrFail();
        $antecedente = AntecedentesFamiliares::where('historia_clinica_id', $historia->id)->firstOrFail();

        // Validar y actualizar datos
        $validated = $request->validate([
            'numero_hijos_vivos' => 'nullable|integer|min:0',
            'numero_hijos_muertos' => 'nullable|integer|min:0',
            'salud_padre' => 'nullable|string|max:255',
            'observacion_padre' => 'nullable|string|max:255',
            'salud_madre' => 'nullable|string|max:255',
            'observacion_madre' => 'nullable|string|max:255',
            'salud_esposo' => 'nullable|string|max:255',
            'observacion_esposo' => 'nullable|string|max:255',
            'salud_hijos' => 'nullable|string|max:255',
            'observacion_hijos' => 'nullable|string|max:255',
            'numero_dependientes' => 'nullable|integer|min:0',
        ]);

        $antecedente->update($validated);

        return redirect()
            ->route('antecedentesFamiliares.editar', ['dni' => $dni])
            ->with('success', 'Antecedentes familiares actualizados correctamente.');
    }
}

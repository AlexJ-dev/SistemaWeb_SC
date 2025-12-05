<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\EvaluacionRadiografia;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class RadiografiaController extends Controller
{

    public function store(Request $request, $evaluacionId)
    {
        $validated = $request->validate([
            'campos_pulmonares' => 'nullable|string',
            'senos' => 'nullable|string',
            'silueta_cardiovascular' => 'nullable|string',
            'vertices' => 'nullable|string',
            'hilo' => 'nullable|string',
            'mediastinos' => 'nullable|string',
            'numero_rayosx' => 'nullable|integer',
            'calidad' => 'nullable|string',
            'fecha' => 'nullable|date',
            'simbolos' => 'nullable|string',
            'evaluacion_radiologica' => 'nullable|string',
            'incidencias_frontales_laterales' => 'nullable|string',
            'conclusiones' => 'nullable|string',
        ]);


        EvaluacionRadiografia::updateOrCreate(
            ['evaluacion_id' => $evaluacionId],
            $validated
        );

        return redirect()->back()->with('success', 'Radiografia registrado correctamente.');
    }

    public function pdf(Evaluacion $evaluacion)
    {
        $radiografia = $evaluacion->radiografia;

        // Obtenemos ruta médica directamente
        $ruta = $evaluacion->rutaMedica;

        // Datos del paciente
        $nombrePaciente = $ruta ? $ruta->apellidos . ' ' . $ruta->nombres : '---';
        $empresa = $ruta->empresa ?? '---';

        // Cargar plantilla
        $templatePath = storage_path('app/plantillas/1placa_radiografica.pdf');

        $pdf = new \setasign\Fpdi\Fpdi();
        $pdf->AddPage();
        $pdf->setSourceFile($templatePath);
        $tpl = $pdf->importPage(1);
        $pdf->useTemplate($tpl);

        $pdf->SetFont('Helvetica', '', 11);
        $pdf->SetTextColor(0, 0, 0);

        /*
    ==========================
    DATOS DEL PACIENTE
    ==========================
    */

        // Nombre del paciente
        $pdf->SetXY(35, 59.5);
        $pdf->Write(0, $nombrePaciente);

        // Tipo de examen
        $pdf->SetXY(35, 65);
        $pdf->Write(0, "Placa Radiografica");

        // Empresa
        $pdf->SetXY(35, 71.5);
        $pdf->Write(0, $empresa);

        // Fecha
        $pdf->SetXY(35, 78.5);
        $pdf->Write(0, $radiografia->fecha ?? date('d/m/Y'));

        // ===== INFORME ARMADO =====

        // Estos campos vienen como STRING, no array
        $campos = $radiografia->campos_pulmonares ?: 'No especificado';
        $senos = $radiografia->senos ?: 'No especificado';
        $silueta = $radiografia->silueta_cardiovascular ?: 'No especificado';

        $textoInforme =
            "La radiografia de torax en la incidencia postero anterior muestra:\n\n" .
            "- Campos pulmonares: $campos\n" .
            "- Senos: $senos\n" .
            "- Silueta cardiovascular: $silueta\n";

        // INFORME
        $pdf->SetXY(20, 110);
        $pdf->MultiCell(170, 5, $textoInforme);


        // CONCLUSIÓN
        $pdf->SetXY(20, 170);
        $conclusiones = is_array($radiografia->conclusiones)
            ? implode(', ', $radiografia->conclusiones)
            : ($radiografia->conclusiones ?? '---');

        $pdf->MultiCell(170, 5, $conclusiones);

        return response($pdf->Output('S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="radiografia.pdf"');
    }
}

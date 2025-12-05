<?php

namespace App\Http\Controllers;

use App\Models\FichaOcupacional;
use App\Models\Enfermedad;
use App\Models\Paciente;
use App\Models\HistoriaClinica;
use App\Models\RutaMedica;
use Illuminate\Http\Request;

class FichaDetalleController extends Controller
{
    public function show(FichaOcupacional $ficha)
    {
        $ficha->load([
            'paciente',
            'historiaClinica.antecedentesMedicos',
            'historiaClinica.antecedentesFamiliares',
            'historiaOcupacional',
            'rutaMedica',
            'evaluaciones.areaOcupacional'
        ]);


        $enfermedades = Enfermedad::all();

        $areas = $ficha->evaluaciones
            ->groupBy('area_ocupacional_id')
            ->map(function ($items) {
                return $items->first()->areaOcupacional;
            });

        return view('ocupacional.ficha_detalle', compact('ficha', 'enfermedades', 'areas'));
    }
}

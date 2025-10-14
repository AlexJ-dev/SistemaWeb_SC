<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use Carbon\Carbon;

class InicioController extends Controller
{
    public function index()
    {
        $hoy = Carbon::today();

        $atenciones = Atencion::with('paciente.fichaOcupacional')
            ->whereDate('registrado_en', $hoy)
            ->latest()
            ->get();

        return view('ocupacional.inicio', compact('atenciones'));
    }
}

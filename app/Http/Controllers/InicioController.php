<?php

namespace App\Http\Controllers;

use App\Models\RutaMedica;
use Carbon\Carbon;

class InicioController extends Controller
{
    public function index()
    {
        $hoy = now()->setTimezone('America/Lima')->toDateString();


        $rutas = RutaMedica::whereDate('registrado_en', $hoy)
            ->latest()
            ->get();


        return view('ocupacional.inicio', compact('rutas'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\RutaMedica;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InicioController extends Controller
{
    public function index(Request $request)
    {
        $hoy = now()->setTimezone('America/Lima')->toDateString();

        // Si el checkbox está activo (mostrar todos), no filtramos por fecha
        if ($request->has('mostrar_todos')) {
            $rutas = RutaMedica::with(['paciente', 'fichaOcupacional'])
                ->latest()
                ->get();
        } else {
            // Mostrar solo los registrados hoy
            $rutas = RutaMedica::with(['paciente', 'fichaOcupacional'])
                ->whereDate('registrado_en', $hoy)
                ->latest()
                ->get();
        }

        return view('ocupacional.inicio', compact('rutas'));
    }
}

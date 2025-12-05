<?php

namespace App\Http\Controllers;

use App\Models\FichaOcupacional;
use App\Models\Paciente;
use App\Models\HistoriaClinica;
use App\Models\RutaMedica;
use Illuminate\Http\Request;

class FichaOcupacionalController extends Controller
{
    public function index(Request $request)
    {
        $query = FichaOcupacional::with(['paciente', 'historiaClinica', 'rutaMedica'])
            ->orderBy('paciente_id', 'asc');

        $hoy = now('America/Lima')->toDateString();

        // Determinar si se deben aplicar filtros de fecha
        $hayFiltros = $request->filled('apellidos') || $request->filled('dni') ||
            $request->filled('historia') || $request->filled('empresa') ||
            $request->filled('tipo_evaluacion') ||
            $request->filled('estado') ||
            ($request->filled('desde') && $request->filled('hasta'));

        // Checkbox "Hoy"
        $mostrarHoy = $request->boolean('hoy', false);

        // Si es la primera carga (sin filtros y sin parámetros), activar Hoy automáticamente
        if ($request->query->count() === 0) {
            $mostrarHoy = true;
        }

        // Filtrar por hoy si el checkbox está activo
        if ($mostrarHoy) {
            $query->whereDate('created_at', $hoy);
        } elseif ($request->filled('desde') && $request->filled('hasta')) {
            $query->whereBetween('created_at', [
                $request->desde . ' 00:00:00',
                $request->hasta . ' 23:59:59'
            ]);
        }

        // === Filtros adicionales ===
        if ($request->filled('apellidos')) {
            $query->whereHas('paciente', function ($q) use ($request) {
                $q->where('apellidos', 'like', "%{$request->apellidos}%");
            });
        }

        if ($request->filled('dni')) {
            $query->whereHas('paciente', function ($q) use ($request) {
                $q->where('documento', 'like', "%{$request->dni}%");
            });
        }

        if ($request->filled('historia')) {
            $query->whereHas('historiaClinica', function ($q) use ($request) {
                $q->where('numero_historia', 'like', "%{$request->historia}%");
            });
        }
        if ($request->filled('estado_ruta')) {
            $query->whereHas('rutaMedica', function ($q) use ($request) {
                $q->where('estado', $request->estado_ruta);
            });
        }

        if ($request->filled('empresa')) {
            $query->where('empresa', 'like', "%{$request->empresa}%");
        }

        if ($request->filled('tipo_evaluacion')) {
            $query->where('tipo_evaluacion', $request->tipo_evaluacion);
        }

        // === Resultados ===
        $fichas = $query->paginate(10)->appends($request->query());

        return view('ocupacional.ficha', compact('fichas', 'mostrarHoy', 'hoy'));
    }





    public function crear($id)
    {

        $rutaMedica = RutaMedica::findOrFail($id);
        $paciente = Paciente::where('documento', $rutaMedica->documento)->firstOrFail();
        $historiaClinica = HistoriaClinica::where('paciente_id', $paciente->id)->first();

        return view('ocupacional.ficha.crear', compact('paciente', 'historiaClinica', 'rutaMedica'));
    }


    public function guardar(Request $request)
    {
        $validated = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'historia_clinica_id' => 'nullable|exists:historias_clinicas,id',
            'ruta_medica_id' => 'nullable|exists:ruta_medica,id',
            'tipo_evaluacion' => 'required|string|max:255',
            'empresa' => 'nullable|string|max:255',
            'contratista' => 'nullable|string|max:255',
            'puesto_postula' => 'nullable|string|max:255',
            'puesto_actual' => 'nullable|string|max:255',
            'tiempo_puesto_actual' => 'nullable|string|max:255',
            'exploracion_procesados' => 'nullable|string|max:255',
            'altitud' => 'nullable|string|max:255',
        ]);

        // Obtener el último número de ficha
        $ultimoNumero = FichaOcupacional::max('id') ?? 0;
        $nuevoNumero = 'F-' . str_pad($ultimoNumero + 1, 6, '0', STR_PAD_LEFT);

        $ficha = FichaOcupacional::create([
            ...$validated,
            'numero_ficha' => $nuevoNumero,
        ]);

        return redirect()->route('evaluaciones')
            ->with('success', 'Ficha Ocupacional registrada correctamente.');
    }
    public function editar($id)
    {
        // Cargar ficha con relaciones clave
        $ficha = FichaOcupacional::with(['paciente', 'historiaClinica', 'rutaMedica'])->findOrFail($id);

        // Obtener paciente e historia ligados a la ficha
        $paciente = $ficha->paciente; // aquí garantizamos que exista
        $historiaClinica = $ficha->historiaClinica ?? null;
        $rutaMedica = $ficha->rutaMedica ?? null;

        // Pasar todo a la vista
        return view('ocupacional.ficha.editar', compact('ficha', 'paciente', 'historiaClinica', 'rutaMedica'));
    }

    public function actualizar(Request $request, $id)
    {
        // Validación básica
        $request->validate([
            'tipo_evaluacion' => 'required|string',
            'empresa' => 'nullable|string|max:255',
            'contratista' => 'nullable|string|max:255',
            'puesto_postula' => 'nullable|string|max:255',
            'puesto_actual' => 'nullable|string|max:255',
            'tiempo_puesto_actual' => 'nullable|string|max:255',
            'exploracion_procesados' => 'required|string',
            'altitud' => 'required|string',
        ]);

        // Buscar la ficha
        $ficha = FichaOcupacional::findOrFail($id);

        // Actualizar datos
        $ficha->update([
            'tipo_evaluacion' => $request->tipo_evaluacion,
            'empresa' => $request->empresa,
            'contratista' => $request->contratista,
            'puesto_postula' => $request->puesto_postula,
            'puesto_actual' => $request->puesto_actual,
            'tiempo_puesto_actual' => $request->tiempo_puesto_actual,
            'exploracion_procesados' => $request->exploracion_procesados,
            'altitud' => $request->altitud,
        ]);

        // Redirección con mensaje
        return redirect()
            ->back()
            ->with('success', 'Ficha ocupacional actualizada correctamente.');
    }
}

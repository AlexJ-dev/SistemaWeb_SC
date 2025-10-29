<?php

namespace App\Http\Controllers;

use App\Models\AreaOcupacional;
use Illuminate\Http\Request;

class AreaOcupacionalController extends Controller
{
    /**
     * Muestra la vista con el listado y formulario de áreas.
     */
    public function index()
    {
        $areas = AreaOcupacional::all();
        return view('ocupacional.mantenimiento.areas', compact('areas'));
    }

    /**
     * Almacena una nueva área.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        AreaOcupacional::create([
            'nombre' => strtoupper($request->nombre),
            'ubicacion' => strtoupper($request->ubicacion),
            'descripcion' => $request->descripcion,
        ]);


        return redirect()->route('areas.index')->with('success', 'Área registrada correctamente.');
    }

    /**
     * Actualiza un área existente.
     */
    public function update(Request $request, AreaOcupacional $area)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $area->update([
            'nombre' => strtoupper($request->nombre),
            'ubicacion' => strtoupper($request->ubicacion),
            'descripcion' => $request->descripcion,
        ]);


        return redirect()->route('areas.index')->with('success', 'Área actualizada correctamente.');
    }

    /**
     * Elimina un área.
     */
    public function destroy(AreaOcupacional $area)
    {
        $area->delete();

        return redirect()->route('areas.index')->with('success', 'Área eliminada correctamente.');
    }
}

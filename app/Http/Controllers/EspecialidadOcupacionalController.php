<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\EspecialidadOcupacional;

class EspecialidadOcupacionalController extends Controller
{
    public function index()
    {
        $especialidades = EspecialidadOcupacional::all();
        return view('ocupacional.mantenimiento.especialidades', compact('especialidades'));
    }

    public function create()
    {
        return view('ocupacional.mantenimiento.especialidades');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:especialidades_ocupacionales,nombre',
        ]);

        EspecialidadOcupacional::create($request->all());
        return redirect()->route('ocupacional.mantenimiento.especialidades.index')->with('success', 'Especialidad registrada.');
    }
    public function update(Request $request, EspecialidadOcupacional $especialidad)
    {
        $request->validate([
            'nombre' => 'required|unique:especialidades_ocupacionales,nombre,' . $especialidad->id,
        ]);

        $especialidad->update([
            'nombre' => strtoupper($request->nombre),
            'descripcion' => strtoupper($request->descripcion),
        ]);

        return redirect()->route('ocupacional.mantenimiento.especialidades.index')->with('success', 'Especialidad actualizada correctamente.');
    }
    public function destroy(EspecialidadOcupacional $especialidad)
    {
        $especialidad->delete();

        return redirect()->route('ocupacional.mantenimiento.especialidades.index')->with('success', 'Especialidad eliminada correctamente.');
    }
}

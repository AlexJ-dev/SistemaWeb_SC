<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\EspecialidadOcupacional;
use Illuminate\Http\Request;
use App\Models\Rol;

class PersonalController extends Controller
{
    public function index()
    {
        $personal = Personal::with('especialidad', 'rol')->get();
        $especialidades = EspecialidadOcupacional::all();
        $roles = Rol::all();

        return view('ocupacional.mantenimiento.personal', compact('personal', 'especialidades', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'apellido' => 'required|string',
            'nombre' => 'required|string',
            'sexo' => 'required|in:M,F',
            'dni' => 'required|unique:personal,dni',
            'telefono' => 'nullable|string',
            'direccion' => 'nullable|string',
            'fecha_nacimiento' => 'nullable|date',
            'edad' => 'nullable|integer',
            'cmp' => 'nullable|string',
            'especialidad_id' => 'nullable|exists:especialidades_ocupacionales,id',
            'rol_id' => 'nullable|exists:roles,id', 
        ]);

        Personal::create($request->all());

        return redirect()->back()->with('success', 'Personal registrado correctamente.');
    }

    public function update(Request $request, Personal $personal)
    {
        $request->validate([
            'apellido' => 'required|string',
            'nombre' => 'required|string',
            'sexo' => 'required|in:M,F',
            'dni' => 'required|unique:personal,dni,' . $personal->id,
            'telefono' => 'nullable|string',
            'direccion' => 'nullable|string',
            'fecha_nacimiento' => 'nullable|date',
            'edad' => 'nullable|integer',
            'cmp' => 'nullable|string',
            'especialidad_id' => 'nullable|exists:especialidades_ocupacionales,id',
            'rol_id' => 'nullable|exists:roles,id', 
        ]);

        $personal->update($request->all());

        return redirect()->back()->with('success', 'Ficha actualizada correctamente.');
    }

    public function destroy(Personal $personal)
    {
        $personal->delete();

        return redirect()->back()->with('success', 'Personal eliminado.');
    }
}

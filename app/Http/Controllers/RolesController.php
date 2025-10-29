<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Rol::all();
        return view('ocupacional.mantenimiento.roles', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:roles,nombre',
            'descripcion' => 'nullable|string|max:255',
        ]);

        Rol::create([
            'nombre' => strtoupper($request->nombre),
            'descripcion' => strtoupper($request->descripcion),
        ]);

        return redirect()->route('ocupacional.mantenimiento.roles.index')->with('success', 'Rol registrado correctamente.');
    }

    public function update(Request $request, Rol $rol)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:roles,nombre,' . $rol->id,
            'descripcion' => 'nullable|string|max:255',
        ]);

        $rol->update([
            'nombre' => strtoupper($request->nombre),
            'descripcion' => strtoupper($request->descripcion),
        ]);

        return redirect()->route('ocupacional.mantenimiento.roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy(Rol $rol)
    {
        $rol->delete();
        return redirect()->route('ocupacional.mantenimiento.roles.index')->with('success', 'Rol eliminado correctamente.');
    }
}

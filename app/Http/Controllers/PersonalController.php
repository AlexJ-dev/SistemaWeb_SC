<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
            'apellido' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'sexo' => 'required|in:M,F',
            'dni' => 'required|digits:8|unique:personal,dni',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'edad' => 'required|integer|min:0',
            'cmp' => 'nullable|string|max:20',
            'especialidad_id' => 'nullable|exists:especialidades_ocupacionales,id',
            'rol_id' => 'required|exists:roles,id',
        ], [
            'dni.unique' => 'El número de DNI ya está registrado.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
        ]);

        $data = $request->all();

        // Calcular edad si hay fecha de nacimiento
        if ($request->filled('fecha_nacimiento')) {
            $data['edad'] = Carbon::parse($request->fecha_nacimiento)->age;
        }

        Personal::create($data);

        return redirect()->route('ocupacional.mantenimiento.personal.index')
            ->with('success', 'Personal registrado correctamente.');
    }

    public function update(Request $request, Personal $personal)
    {
        $validated = $request->validate([
            'apellido' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'sexo' => 'required|in:M,F',
            'dni' => 'required|digits:8|unique:personal,dni,' . $personal->id,
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'edad' => 'nullable|integer',
            'cmp' => 'nullable|string|max:20',
            'especialidad_id' => 'nullable|exists:especialidades_ocupacionales,id',
            'rol_id' => 'required|exists:roles,id',
        ]);
        $data = $request->all();

        if ($request->filled('fecha_nacimiento')) {
            $data['edad'] = Carbon::parse($request->fecha_nacimiento)->age;
        }

        $personal->update($data);
        $personal->update($validated);

        return redirect()->back()->with('success', 'Ficha actualizada correctamente.');
    }

    public function destroy(Personal $personal)
    {
        $personal->delete();

        return redirect()->back()->with('success', 'Personal eliminado.');
    }
    public function verificarDni($dni, Request $request)
    {
        $excludeId = $request->query('exclude');
        $query = Personal::where('dni', $dni);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        return response()->json($query->exists());
    }
    public function verificarDniEditar($dni, $id)
    {
        $existe = \App\Models\Personal::where('dni', $dni)
            ->where('id', '!=', $id)
            ->exists();

        return response()->json($existe); 
    }
}

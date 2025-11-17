<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all();
        return view('ocupacional.empresa', compact('empresas'));
    }

    public function create()
    {
        return view('ocupacional.empresas.crear');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'ruc' => 'required|string|max:11',
            'rubro' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'nombre_abreviado' => 'nullable|string|max:100',
            'persona_contacto' => 'nullable|string|max:255',
            'telefono_contacto' => 'nullable|string|max:20',
            'email_contacto' => 'nullable|email|max:255',
            'departamento' => 'nullable|string|max:100',
            'provincia' => 'nullable|string|max:100',
            'distrito' => 'nullable|string|max:100',
        ]);

        $data['nombre'] = mb_strtoupper($data['nombre'], 'UTF-8');
        $data['nombre_abreviado'] = mb_strtoupper($data['nombre_abreviado'] ?? '', 'UTF-8');
        $data['direccion'] = mb_strtoupper($data['direccion'] ?? '', 'UTF-8');
        $data['rubro'] = mb_strtoupper($data['rubro'] ?? '', 'UTF-8');
        $data['persona_contacto'] = mb_strtoupper($data['persona_contacto'] ?? '', 'UTF-8');

        Empresa::create($data);
        return redirect()->route('empresa')->with('success', 'Empresa registrada correctamente.');
    }

    public function edit(Empresa $empresa)
    {
        return view('ocupacional.empresas.editar', compact('empresa'));
    }

    public function update(Request $request, Empresa $empresa)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'ruc' => 'required|string|max:11',
            'rubro' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'nombre_abreviado' => 'nullable|string|max:100',
            'persona_contacto' => 'nullable|string|max:255',
            'telefono_contacto' => 'nullable|string|max:20',
            'email_contacto' => 'nullable|email|max:255',
            'departamento' => 'nullable|string|max:100',
            'provincia' => 'nullable|string|max:100',
            'distrito' => 'nullable|string|max:100',
        ]);
        $data['nombre'] = mb_strtoupper($data['nombre'], 'UTF-8');
        $data['nombre_abreviado'] = mb_strtoupper($data['nombre_abreviado'] ?? '', 'UTF-8');
        $data['direccion'] = mb_strtoupper($data['direccion'] ?? '', 'UTF-8');
        $data['rubro'] = mb_strtoupper($data['rubro'] ?? '', 'UTF-8');
        $data['persona_contacto'] = mb_strtoupper($data['persona_contacto'] ?? '', 'UTF-8');

        $empresa->update($data);
        return redirect()->route('empresa')->with('success', 'Empresa actualizada correctamente.');
    }
    public function listado()
    {
        // Ajusta columnas que necesites
        $empresas = Empresa::select('id','nombre','nombre_abreviado')->orderBy('nombre')->get();
        return response()->json($empresas);
    }
}

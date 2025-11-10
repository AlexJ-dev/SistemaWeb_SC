<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    /**
     * Muestra la vista de usuarios con la tabla y el formulario.
     */
    public function index()
    {
        $usuarios = User::with('personal.rol')->get();
        $personal = Personal::with('rol')->get();

        return view('ocupacional.mantenimiento.usuarios', compact('usuarios', 'personal'));
    }

    /**
     * Registra un nuevo usuario clínico.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users,name'],
            'password' => ['required', 'string', 'min:6'],
            'personal_id' => ['required', 'exists:personal,id'],
        ]);

        User::create([
            'name' => strtoupper($request->name),
            'password' => Hash::make($request->password),
            'password_visible' => $request->password, // ← campo visible para mostrar/copiar
            'personal_id' => $request->personal_id,
        ]);

        return redirect()->route('ocupacional.mantenimiento.usuarios.index')->with('success', 'Usuario registrado correctamente.');
    }

    /**
     * Actualiza los datos de un usuario existente.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users,name,' . $user->id],
            'personal_id' => ['required', 'exists:personal,id'],
        ]);

        $user->update([
            'name' => strtoupper($request->name),
            'personal_id' => $request->personal_id,
        ]);

        return redirect()->route('ocupacional.mantenimiento.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina un usuario del sistema.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('ocupacional.mantenimiento.usuarios.index')->with('success', 'Usuario eliminado.');
    }
    public function verificarUsuario($name, $password)
    {
        $existeUsuario = \App\Models\User::whereRaw('UPPER(name) = ?', [strtoupper($name)])->exists();
        $existePassword = \App\Models\User::where('password_visible', $password)->exists();

        return response()->json([
            'name' => $existeUsuario,
            'password' => $existePassword,
        ]);
    }
}

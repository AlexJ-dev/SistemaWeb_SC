<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users,name'],
            'password' => ['required', 'string', 'min:6'],
            'rol_id' => ['required', 'exists:roles,id'],
            'personal_id' => ['required', 'exists:personal,id'],
        ]);

        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'rol_id' => $request->rol_id,
            'personal_id' => $request->personal_id,
        ]);

        return redirect()->route('ocupacional.mantenimiento.usuarios.index')->with('success', 'Usuario registrado correctamente.');
    }
}

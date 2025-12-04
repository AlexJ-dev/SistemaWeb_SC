<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View|RedirectResponse
    {
        if (Auth::check()) {
            // Verifica si la sesión aún está marcada como válida
            if (!session()->has('login_verified')) {
                // Cierra sesión si la cookie existe pero la sesión no
                Auth::logout();
                session()->invalidate();
                session()->regenerateToken();

                return redirect()->route('login')->with('error', 'Tu sesión expiró. Por favor, inicia sesión nuevamente.');
            }

            return redirect()->route('inicio');
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Marca la sesión como verificada
        session(['login_verified' => true]);

        return redirect()->intended(route('inicio'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

   
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidateSession
{
    public function handle(Request $request, Closure $next)
{
    if (app()->environment('local', 'staging')) {
        if ($request->hasCookie('laravel_session') && !session()->has('login_verified')) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Elimina la cookie rota
            return redirect()->route('login')
                ->withCookie(cookie()->forget('laravel_session'))
                ->with('error', 'Tu sesión expiró. Por favor, inicia sesión nuevamente.');
        }
    }

    return $next($request);
}

}

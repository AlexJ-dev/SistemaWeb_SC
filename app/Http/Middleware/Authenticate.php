<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Devuelve la ruta de login si es necesario redirigir.
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login'); // ajusta si tu ruta de login es otra
        }
    }
}

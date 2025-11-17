<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckRole
{
    public function handle(Request $request, Closure $next, ...$rolesPermitidos)
    {
        $user = Auth::user();

        if (!$user || !$user->rol) {
            abort(403, 'No tienes rol asignado.');
        }

        // Rol real del usuario
        $rolUsuario = strtolower($user->rol->nombre);

        // Normalizamos roles permitidos
        $rolesPermitidos = array_map('strtolower', $rolesPermitidos);

        // Validación
        if (in_array($rolUsuario, $rolesPermitidos)) {
            return $next($request);
        }

        abort(403, 'No tienes permiso para acceder a esta sección.');
    }
}

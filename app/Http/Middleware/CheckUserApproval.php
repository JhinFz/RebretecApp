<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserApproval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    // : Response
    {

        // Permitir el acceso a solicitudes PUT
        if ($request->isMethod('put')) {
            return $next($request);
        }

        // Verifica si el usuario está autenticado
        if (Auth::check() && !Auth::user()->is_approved) {

            Auth::logout();
            // Redirige a la página de inicio o muestra un mensaje
            return redirect()->route('bienvenida')->with('info', 'Su cuenta no ha sido aprobada. Por favor, espere a la aprobación del administrador e inicie sesión.');
        }

        return $next($request);
    }
}
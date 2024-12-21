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
        //  // Permitir el acceso a las rutas de login y registro solo si el usuario no está autenticado
        //  if ($request->is('login') || $request->is('register')) {
        //     if (Auth::check()) {
        //         // Si el usuario está autenticado, redirigir a la página deseada
        //         return redirect()->route('home'); // Cambia 'home' a la ruta que desees
        //     }
        //     return $next($request); // Permitir acceso si no está autenticado
        // }

        // Verifica si el usuario está autenticado
        if (Auth::check() && !Auth::user()->is_approved) {

            Auth::logout();
            // Redirige a la página de inicio o muestra un mensaje
            return redirect()->route('bienvenida')->with('info', 'Su cuenta no ha sido aprobada. Por favor, espere a la aprobación del administrador e inicie sesión.');
        }

        return $next($request);
    }
}
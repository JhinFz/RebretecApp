<?php

namespace App\Http\Controllers\Institucion;

use App\Http\Controllers\Controller;
use App\Models\Laboratorio;
use App\Models\PerfilInstitucion;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormularioController extends Controller
{
    // public function __construct()
    //  {
    //     $this->middleware('can:institucion.formulario.index')->only('index', 'store');
    //  }

     public function index()
    {
        $laboratorios = Laboratorio::where('id_perfil', Auth::user()->PerfilInstitucion->id_perfil ?? null)->get();// Filtra los laboratorios por el ID del la institucion
        $perfil = PerfilInstitucion::where('user_id', Auth::id())->first();
        return view('institucion.form', compact('laboratorios','perfil'));
    }

    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'asunto' => ['required', 'string', 'max:255'],
            'detalles' => ['required', 'string', 'max:255'],
        ]);

        // Verificar si hay al menos un laboratorio registrado y perfil de institucion
        $perfil = Auth::user()->perfilInstitucion; 
        $laboratorios = Laboratorio::where('id_perfil', $perfil->id_perfil)->get();

        if ($laboratorios->isEmpty()) {
            return redirect()->back()->withErrors(['error' => 'Debes registrar al menos un laboratorio.']);

        } 
        elseif (!$perfil) {
            return redirect()->back()->withErrors(['error' => 'Debes registrar un perfil para el usuario autenticado.']);
        }
        else {

            $solicitud = new Solicitud();
            $solicitud->id_perfil = Auth::user()->perfilInstitucion->id_perfil;
            $solicitud->asunto = $request->asunto;
            $solicitud->detalles_soli = $request->detalles;
            $solicitud->estado_soli = "procesando";
            
            if ($solicitud->save()) { 
                return redirect()->route('institucion.form.index')->with('success','Solicitud enviada Correctamente');
            } else {
                return redirect()->route('institucion.form.index')->withErrors(['error' => 'Error al enviar solicitud.']);
            }
        }

        return redirect()->route('institucion.form.index')->with('success', 'Mantenimiento registrado con éxito.');
    }
}

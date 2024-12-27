<?php

namespace App\Http\Controllers\Institucion;

use App\Http\Controllers\Controller;
use App\Models\LabSolicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudLabController extends Controller
{
     public function __construct()
     {
        $this->middleware('can:institucion.formulario.index')->only('index');
        $this->middleware('can:institucion.formulario.create')->only('create');
        $this->middleware('can:institucion.formulario.update')->only('edit','update');
     }
     
    public function index()
    {
        $usuario = Auth::user(); // Obtiene el usuario autenticado
        $laboratorios = LabSolicitud::where('user_id', $usuario->id)->get(); // Filtra los laboratorios por el ID del usuario
        // $solicitudes = LabSolicitud::with('user.labSolicitud')->get();
        return view('institucion.create', compact('laboratorios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_lab' => 'required|string|max:255',
            'ubicacion_lab' => 'required|string|max:255',
            'cant_pc' => 'required|string|max:255',
            'd_internet' => 'required|string|max:10',
            'mensaje' => 'required|string|max:255',
        ]);

        $laboratorio = new LabSolicitud();
        $laboratorio->name_lab = $request->name_lab;
        $laboratorio->ubicacion_lab = $request->ubicacion_lab;
        $laboratorio->cant_pc = $request->cant_pc;
        $laboratorio->d_internet = $request->d_internet;
        $laboratorio->mensaje = $request->mensaje;
        $laboratorio->user_id = Auth::id();

        if ($laboratorio->save()) { 
            return redirect()->route('institucion.labsolicitud.index')->with('info','Laboratorio Guardado Correctamente');
        } else {
            return redirect()->route('institucion.labsolicitud.index')->withErrors(['error' => 'Error al actualizar el usuario.']);
        }

        // route('institucion.labsolicitud.index',$laboratorio)
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Institucion;

use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $usuario = Auth::user(); // Obtiene el usuario autenticado
        $solicitudes = Solicitud::where('id_perfil', Auth::user()->PerfilInstitucion->id_perfil ?? null)->get();;
        return view('institucion.solicitudes', compact('solicitudes'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        // Buscar la solicitud por ID
        $solicitud = Solicitud::find($id);

        // Verificar si la solicitud existe
        if (!$solicitud) {
            return redirect()->back()->with('error', 'Solicitud no encontrada.');
        }
        $tecnico = $solicitud->perfilTecnico;
        // Retornar la vista con la información de la solicitud
        return view('institucion.estado_soli', compact('solicitud','tecnico'));
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

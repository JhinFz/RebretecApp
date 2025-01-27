<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use App\Models\Dispositivo;
use App\Models\Laboratorio;
use App\Models\PerfilTecnico;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TecnicoFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $idSoli = $request->input('id_soli');
        
        // Obtén el perfil del técnico autenticado
        $perfilTecnico = PerfilTecnico::where('user_id', Auth::id())->first();
        // Obtiene la solicitud asociada al perfil técnico
        $solicitud = Solicitud::where('id_tecnico', $perfilTecnico->id_perfil)
                    ->where('cumplimiento',false)
                    ->first();
        if ($solicitud) {
             // Obtiene el perfil de institución asociado a la solicitud
            $perfilInstitucion = $solicitud->perfilInstitucion;
            // Obtiene todos los laboratorios asociados y carga dispositivos
            $laboratorios = $perfilInstitucion->laboratorio()->with('dispositivo.diagnosticos.mantenimiento')->get();
            // Filtra los dispositivos que pertenecen al laboratorio
            $dispositivos = $laboratorios->flatMap(function ($laboratorio) {
                return $laboratorio->dispositivo;
            });
            $idSoli = $solicitud->id_soli;
        }
        else {
            $dispositivos = null;
            $laboratorios = null;
            $idSoli = null;
        }
        
    
        return view('tecnico.diagnosticos_equipos', compact('dispositivos','laboratorios','idSoli'));
    }

    public function FinalizarMant(Request $request)
    {
        $idSoli = $request->input('id_soli');

        $solicitud = Solicitud::find($idSoli);
        
        $solicitud->update([
            'cumplimiento' => true,
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Servicio Finalizado Correctamente.');
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

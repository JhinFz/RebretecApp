<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laboratorio;
use App\Models\PerfilTecnico;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;

class AdmSolicitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $usuario = Auth::user(); // Obtiene el usuario autenticado
        $solicitudes = Solicitud::where('estado_soli', 'procesando')->get();;
        return view('admin.solicitudes.solicitud_index', compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
        $solicitud = Solicitud::find($id);
        if (!$solicitud) {
            return redirect()->back()->with('error', 'Solicitud no encontrada.');
        }
        $tecnicos = User::where('tipo_usuario', 'tecnico')
                        ->whereHas('perfilTecnico') // Asegurarse de que tenga un perfil
                        ->whereDoesntHave('perfilTecnico.solicitud', function ($query) {
                            $query->where('cumplimiento', false);
                        }) // Excluir perfiles con solicitudes con cumplimiento false
                        ->with(['perfilTecnico:id_perfil,user_id'])
                        ->select('id', 'name')
                        ->get();

        $laboratorios = Laboratorio::where('id_perfil', $solicitud->id_perfil)->get();
        return view('admin.solicitudes.visualizar', compact('solicitud','tecnicos','laboratorios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_tecnico' => 'required|string|max:255',
        ]);
    
        $solicitud = Solicitud::find($id);
        if (!$solicitud) {
            return redirect()->back()->with('error', 'Solicitud no encontrada.');
        }

        if ($solicitud->update($request->only('id_tecnico'))) {

            if ($solicitud->estado_soli == 'procesando') {
                $solicitud->estado_soli = 'aprobado';
                $solicitud->fecha_aceptacion = now();
                $solicitud->save();
                return redirect()->route('admin.solicitud.index')->with('success', 'Solicitud aprobada correctamente.');
            }
            else {
                return redirect()->route('seguimiento')->with('success', 'Técnico asignado correctamente.');
            }
            
        } else {
            return response()->json(['error' => 'No se procesó la solicitud.'], 500);
        }
        
        

        // return response()->json([
        //     'id_tecnico' => $request->input('id_tecnico'),
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            // Busca la solicitud por su ID
        $solicitud = Solicitud::find($id);

        if (!$solicitud) {
            return back()->with('error', 'Solicitud no encontrada');
        }

        // Actualiza el estado de la solicitud a 'rechazado'
        $solicitud->estado_soli = 'rechazado';
        $solicitud->save();

        // Redirige con un mensaje de éxito
        return back()->with('success', 'Solicitud rechazada con éxito');
    }
}

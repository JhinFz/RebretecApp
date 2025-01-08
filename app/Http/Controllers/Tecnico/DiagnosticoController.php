<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use App\Models\Diagnostico;
use App\Models\Dispositivo;
use Illuminate\Http\Request;

class DiagnosticoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'nombre_diag' => 'required|string|max:255',
            'diagnostico_detail' => 'required|string|max:255',
        ]);

        $diagnostico = new Diagnostico();
        $diagnostico->id_pc = $request->id_pc;
        $diagnostico->nombre_diag = $request->nombre_diag;
        $diagnostico->diagnostico_detail = $request->diagnostico_detail;
        
        if ($diagnostico->save()) { 
            return redirect()->back()->with('info','Laboratorio Guardado Correctamente');
        } else {
            return redirect()->back()->withErrors(['error' => 'Error al actualizar el usuario.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dispositivo = Dispositivo::with('diagnosticos')->find($id);
        //verificacion
        if (!$dispositivo) {
            return redirect()->back()->with('error', 'Dispositivo no encontrado.');
        }
        return view('tecnico.diagnostico', compact('dispositivo'));
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

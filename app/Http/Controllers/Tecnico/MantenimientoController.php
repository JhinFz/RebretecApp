<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use App\Models\Diagnostico;
use App\Models\Dispositivo;
use App\Models\Mantenimiento;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_diag' => 'required|string|max:255',
            'actividades' => 'required|string|max:255',
        ]);

        $mantenimiento = new Mantenimiento();
        $mantenimiento->id_diag = $request->id_diag;
        $mantenimiento->actividades = $request->actividades;

        // Eliminar el diagnóstico de la sesión
        session()->forget('diagnostico');

        if ($mantenimiento->save()) { 
            return redirect()->back()->with('success','Laboratorio Guardado Correctamente');
        } else {
            return redirect()->back()->withErrors(['error' => 'Error al actualizar el usuario.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtén el dispositivo con sus diagnósticos y mantenimientos
    $dispositivo = Dispositivo::with('diagnosticos.mantenimiento')->find($id);

    // Verifica si se ha encontrado
    if (!$dispositivo) {
        return redirect()->back()->with('error', 'Dispositivo no encontrado.');
    }

    // Obtener todos los mantenimientos asociados a los diagnósticos
    $mantenimientos = $dispositivo->diagnosticos->pluck('mantenimiento')->filter();

        return view('tecnico.mantenimiento', compact('dispositivo','mantenimientos'));
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
        $mantenimientos = Mantenimiento::find($id);

        if (!$mantenimientos) {
            return redirect()->back()->with('error', 'Actividad correctiva no encontrada.');
        }
        else {
            $mantenimientos->delete();
            return redirect()->back()->with('success', 'Actividad correctiva eliminada correctamente.');
        }
    }
}

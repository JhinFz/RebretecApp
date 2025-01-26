<?php

namespace App\Http\Controllers\Institucion;

use App\Http\Controllers\Controller;
use App\Models\Laboratorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LabController extends Controller
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
            'name_lab' => 'required|string|max:255',
            'ubicacion_lab' => 'required|string|max:255',
            'cant_pc' => 'required|string|max:255',
            'd_internet' => 'required|string|max:10',
            'mensaje' => 'required|string|max:255',
        ]);

        $laboratorio = new Laboratorio();
        $laboratorio->id_perfil = Auth::user()->perfilInstitucion->id_perfil;
        $laboratorio->name_lab = $request->name_lab;
        $laboratorio->ubicacion_lab = $request->ubicacion_lab;
        $laboratorio->cant_pc = $request->cant_pc;
        $laboratorio->d_internet = $request->d_internet;
        $laboratorio->detalles_lab = $request->mensaje;
        

        if ($laboratorio->save()) { 
            return redirect()->route('institucion.form.index')->with('success','Laboratorio Guardado Correctamente');
        } else {
            return redirect()->route('institucion.form.index')->withErrors(['error' => 'Error al actualizar el usuario.']);
        }
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
        $laboratorio = Laboratorio::find($id);
        if (!$laboratorio) {
            return redirect()->back()->with('error', 'Laboratorio no encontrado.');
        }
        return view('institucion.update_lab', compact('laboratorio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name_lab' => 'required|string|max:255',
            'ubicacion_lab' => 'required|string|max:255',
            'cant_pc' => 'required|integer',
            'd_internet' => 'required|string',
            'detalles_lab' => 'required|string',
        ]);
    
        $laboratorio = Laboratorio::find($id);
        if (!$laboratorio) {
            return redirect()->back()->with('error', 'Laboratorio no encontrado.');
        }
    
        $laboratorio->update($request->all());
    
        return redirect()->route('institucion.form.index')->with('success', 'Laboratorio actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el laboratorio por ID
        $laboratorio = Laboratorio::find($id);

        // Verificar si el laboratorio existe
        if (!$laboratorio) {
            return redirect()->route('laboratorios.index')->with('error', 'Laboratorio no encontrado.');
        }

        // Eliminar el laboratorio
        $laboratorio->delete();

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('institucion.form.index')->with('success', 'Laboratorio eliminado correctamente.');
    }
}

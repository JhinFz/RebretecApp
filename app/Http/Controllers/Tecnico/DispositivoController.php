<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use App\Models\Dispositivo;
use Illuminate\Http\Request;

class DispositivoController extends Controller
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
            'name_pc' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'serie' => 'required|string|max:255',
        ]);

        $dispositivo = new Dispositivo();
        $dispositivo->name_pc = $request->name_pc;
        $dispositivo->id_lab = $request->id_lab; 
        $dispositivo->marca = $request->marca;
        $dispositivo->modelo = $request->modelo;
        $dispositivo->serie = $request->serie;


        if ($dispositivo->save()) { 
            return redirect()->back()->with('success','Dispositivo guardado exitosamente!');
        } else {
            return redirect()->back()->withErrors(['error' => 'Error al guardar el dispositivo.']);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $request->validate([
        //     'name_lab' => 'required|string|max:255',
        //     'ubicacion_lab' => 'required|string|max:255',
        //     'cant_pc' => 'required|integer',
        //     'd_internet' => 'required|string',
        //     'detalles_lab' => 'required|string',
        // ]);
    
        // $laboratorio = Laboratorio::find($id);
        // if (!$laboratorio) {
        //     return redirect()->back()->with('error', 'Laboratorio no encontrado.');
        // }
    
        // $laboratorio->update($request->all());
    
        // return redirect()->route('institucion.form.index')->with('success', 'Laboratorio actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dispositivo = Dispositivo::find($id);

        // Verificar si el laboratorio existe
        if (!$dispositivo) {
            return redirect()->back()->with('error', 'Dispositivo no encontrado.');
        }
        else {

            // softDelete()
            $dispositivo->delete();
            
            return redirect()->back()->with('success', 'Dispositivo eliminado correctamente.');
        }
   
    }
}

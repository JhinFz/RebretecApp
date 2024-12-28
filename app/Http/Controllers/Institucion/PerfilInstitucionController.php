<?php

namespace App\Http\Controllers\Institucion;

use App\Http\Controllers\Controller;
use App\Models\PerfilInstitucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilInstitucionController extends Controller
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
        // Validator::make($request->all(), [
        //     'instname' => ['required', 'string', 'max:255'],
        //     'telefono' => ['required', 'string', 'max:10'],
        //     'cod_amie' => ['required', 'string', 'max:255'],
        //     'direccion' => ['required', 'string', 'max:255'],
        // ])->validate();

        $request->validate([
            'instname' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:10'],
            'cod_amie' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
        ]);

        $usuario = PerfilInstitucion::find($id);

        $usuario->update($request->all());
        // $usuario->instname = $request->input('instname');
        // $usuario->telefono = $request->input('telefono');
        // $usuario->cod_amie = $request->input('cod_amie');
        // $usuario->direccion = $request->input('direccion');
        // $usuario->save();

        return redirect()->route('institucion.form.index')->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

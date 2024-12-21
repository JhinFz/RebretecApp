<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use FontLib\Table\Type\name;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.edit')->only('edit','update');
    }

    public function index()
    {
        return view('admin.users.index');
    }

    public function approve( User $user)
    {
        $user->is_approved = true;
        $user -> save();

        return redirect()->route('admin.users.create',$user)->with('success', 'Usuario aprobado correctamente.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $usuario)
    {

        $usuarios = User::all();
        return view('admin.users.create', compact('usuarios'));
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
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        $roles = Role::All();
        return view('admin.users.edit',compact('usuario','roles'));
        // return $usuario;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $usuario->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

       // Actualizar el usuario
       $usuario->name = $request->name;
       $usuario->email = $request->email;

       // Actualizar la contraseña si se proporciona
       if ($request->password) {
           $usuario->password = Hash::make($request->password);
       }

       $usuario->save(); // Guardar los cambios en el usuario

        $usuario->roles()->sync($request->roles);
        

        if ($usuario->save()) { 
            // Sincronizar los roles
            $usuario->roles()->sync($request->roles);
    
            // Redirigir con un mensaje de éxito
            return redirect()->route('admin.users.edit',$usuario)->with('info','Usuario Actualizado Correctamente');
        } else {
            // Manejar el error en caso de que el guardado falle
            return redirect()->back()->withErrors(['error' => 'Error al actualizar el usuario.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->back()->with('success', 'Usuario eliminado exitosamente.');
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Contacto;
use Barryvdh\DomPDF\Facade\Pdf;

class ContactanosController extends Controller
{
    //se encarga de mostrar la vista de usuario del formulario
    public function index() {
        return view('contactanos.index');
    }
    //muestra la vista de base
    public function vista()
    {   
        //se cargan los registros de la Base de datos
        $contactos = Contacto::all();
        return view('contactanos.registros')->with('contactos',$contactos);
    }
    //procesa el formulario y envia el correo electronico
    public function store(Request $request) {

        //validar datos del formulario

        $request->validate([
            'instname'=>'required|max:256',
            'name'=>'required|max:256',
            'correo'=>'required|email|max:256',
            'telefono'=>'required|digits:10',
            'direccion'=>'required|max:256',
            'mensaje'=>'nullable|string|max:256',
        ]);

        //$correo = new ContactanosMailable($request->all());
        //Mail::to('jhinson.zabala@espoch.edu.ec')->send($correo);

        $sql=DB::insert('insert into contactos(instname, name, correo, telefono, direccion, mensaje) values (?, ?, ?, ?, ?, ?)', [
            $request->instname,
            $request->name,
            $request->correo,
            $request->telefono,
            $request->direccion,
            $mensaje = empty($request->mensaje) ? null : $request->mensaje
        ]); 

        if($sql==true){
            return back()->with("correcto","Mensaje enviado correctamente =)");
        }else{
            return back()->with("incorrecto","Error al enviar, intentelo de nuevo");
        }
    }
    public function pdf()
    {
        $contactos = Contacto::all();
        $pdf = Pdf::loadView('contactanos.pdf', compact('contactos'))->setPaper('a4', 'landscape');
        return $pdf->stream('solicitudes.pdf');
    }

    public function destroy(Contacto $contacto)
    {
        $contacto->delete();
        return redirect()->back()->with('success', 'Solicitud rechazada correctamente.');
    }
}

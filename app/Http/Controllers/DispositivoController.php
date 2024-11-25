<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Dispositivo;
use Barryvdh\DomPDF\Facade\Pdf;

class DispositivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dispositivos = Dispositivo::all();
        return view('dispositivo.index')->with('dispositivos',$dispositivos);
    }

    public function form(){
        return view('dispositivo.create');
    }

    public function pdf()
    {
        $dispositivos = Dispositivo::all();
        $pdf = Pdf::loadView('dispositivo.pdf', compact('dispositivos'))->setPaper('a4', 'landscape');
        return $pdf->stream('donaciones.pdf');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'cl'=>'required',
            'tecnico_ingeniero'=>'required'
        ]);
        
        $sql=DB::insert('insert into dispositivos(nombres, mail, lugar, telefono, fecha, hora, p_recoleccion, d_equipos, tipo, marca, modelo, serie, detalle, observaciones, n_donante, ci, t_ingeniero) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $request->nombres,
            $request->correo,
            $request->lugar,
            $request->telefono,
            $request->fecha,
            $request->hora,
            $request->punto_recoleccion,
            $request->detalle,
            $request->tipos,
            $request->marca,
            $request->modelo,
            $request->serie,
            $request->detalle2,
            $request->observaciones,
            $request->nombre_donador,
            $request->cl,
            $request->tecnico_ingeniero
        ]); 

        if($sql==true){
            return back()->with("correcto","Donación registrada correctamente");
        }else{
            return back()->with("incorrecto","Error al registrar");
        }
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
        $dispositivo = Dispositivo::find($id);
        return view('dispositivo.edit')->with('dispositivo',$dispositivo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{

            $sql = DB::update('update dispositivos set nombres=?, mail=?, lugar=?, telefono=?, fecha=?, hora=?, p_recoleccion=?, d_equipos=?, tipo=?, marca=?, modelo=?, serie=?, detalle=?, observaciones=?, n_donante=?, ci=?, t_ingeniero=? where id=?', [
                
                $request->txtnombres,
                $request->txtmail,
                $request->txtlugar,
                $request->txttelf,
                $request->txtfecha,
                $request->txthora,
                $request->txtprecoleccion,
                $request->txtdetalleq,
                $request->txttipo,
                $request->txtmarca,
                $request->txtmodelo,
                $request->txtserie,
                $request->txtdetalle,
                $request->txtobservacion,
                $request->txtnombre,
                $request->txtci,
                $request->txtencargado,
                $request->txtid,
            ]); 
            
            if($sql==0){
                $sql=1;
            }

        }catch(\Throwable $th){
            $sql=0;
        }
    

        if($sql==true){
            return back()->with("correcto","Donación modificada correctamente");
        }else{
            return back()->with("incorrecto","Error al modificar");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        {
            try{
            
            $sql=DB::delete("delete from dispositivos where id = $id");
            
                        
            } catch(\Throwable $th){
                $sql=0;
            }
            if($sql==true){
                return back()->with("correcto","Registro eliminado correctamente");
            }else{
                return back()->with("incorrecto","Error al eliminar");
            }
            
            
        }
        
    }
}

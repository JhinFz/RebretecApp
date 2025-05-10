<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dispositivo;
use App\Models\Solicitud;
use Illuminate\Http\Request;

class AdmSeguimiento extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solicitudes = Solicitud::where('estado_soli', 'aprobado')->get();;
        return view('admin.seguimiento.index', compact('solicitudes'));
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
        $solicitud = Solicitud::find($id);
        if (!$solicitud) {
            return redirect()->back()->with('error', 'Solicitud no encontrada.');
        }
        
        // Obtiene todos los laboratorios asociados y carga dispositivos
        $laboratorios = $solicitud->perfilInstitucion->laboratorio()->with('dispositivo.diagnosticos.mantenimiento')->get();
        // Filtra los dispositivos que pertenecen al laboratorio
        $dispositivos = $laboratorios->flatMap(function ($laboratorio) {
                return $laboratorio->dispositivo;
            });
        $idSoli = $solicitud->id_soli;
        
        return view('admin.seguimiento.visualizar', compact('dispositivos','laboratorios','idSoli'));
    }

    public function showMantenimiento(string $id)
    {
        // Obtén el dispositivo con sus diagnósticos y mantenimientos
        $dispositivo = Dispositivo::with('diagnosticos.mantenimiento')->find($id);

        // Verifica si se ha encontrado
        if (!$dispositivo) {
            return redirect()->back()->with('error', 'Dispositivo no encontrado.');
        }

        // Obtener todos los mantenimientos asociados a los diagnósticos
        $mantenimientos = $dispositivo->diagnosticos->pluck('mantenimiento')->filter();

        return view('admin.seguimiento.mantenimiento', compact('dispositivo','mantenimientos'));
    }

    public function showDiagnosticos(string $id)
    {
        $dispositivo = Dispositivo::with('diagnosticos')->find($id);
        //verificacion
        if (!$dispositivo) {
            return redirect()->back()->with('error', 'Dispositivo no encontrado.');
        }
        return view('admin.seguimiento.diagnostico', compact('dispositivo'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Diagnostico;
use App\Models\Dispositivo;
use App\Models\Laboratorio;
use App\Models\Mantenimiento;
use App\Models\PerfilInstitucion;
use App\Models\PerfilTecnico;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class ReporteController extends Controller
{
    public function mostrarFormAdmin()
    {
        $datasets = [
            1 => 'Usuarios Registrados',
            2 => 'Solicitudes Recibidas',
            3 => 'Solicitudes Aprobadas',
            4 => 'Solicitudes Rechazadas',
            5 => 'Solicitudes Completadas'
        ];
    
        return view('reportes.parametros', compact('datasets'));
    }

    public function reporteAdmin(Request $request)
    {
        // Validar las fechas recibidas
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Obtener las fechas
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        if ($request->data_set == 1) {
            //filtrar por fechas
            $users = User::whereBetween('created_at', [$startDate, $endDate])->get();
            $pdf = FacadePdf::loadView('reportes.usuarios', compact('users', 'startDate', 'endDate'));    
        }
        if (in_array($request->data_set, [2, 3, 4, 5])) {

            //filtrar por fechas
            $solicitudes = Solicitud::with('perfilTecnico')->whereBetween('created_at', [$startDate, $endDate])->get();
            
            if ($request->data_set == 3) {

                $solicitudes = $solicitudes->where('estado_soli', 'aprobado');
                   
            }
            if ($request->data_set == 4) {

                $solicitudes = $solicitudes->where('estado_soli', 'rechazado');
                   
            }
            if ($request->data_set == 5) {

                $solicitudes = $solicitudes->where('cumplimiento', true);
                   
            }
            $pdf = FacadePdf::loadView('reportes.solicitudes', compact('solicitudes', 'startDate', 'endDate'));
        }
        
        return $pdf->stream('reporteAdmin.pdf');
    }

    public function reporteTecnico(Request $request)
    {
        // Validar las fechas recibidas
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Obtener las fechas
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $laboratorios = Laboratorio::with('perfilInstitucion')->whereBetween('created_at', [$startDate, $endDate])->get(); 
        $solicitudes = Solicitud::whereBetween('created_at', [$startDate, $endDate])->get();

        //Laboratorios Atendidos
        if ($request->data_set == 1) {

            $id_institucion = Solicitud::where('id_tecnico', Auth::user()->perfilTecnico->id_perfil)->pluck('id_perfil');
            $laboratorios = Laboratorio::with('perfilInstitucion')->whereBetween('created_at', [$startDate, $endDate])
                            ->whereIn('id_perfil', $id_institucion)
                            ->get(); 
            $pdf = FacadePdf::loadView('reportes.tecnico.labs', compact('laboratorios', 'startDate', 'endDate'));              
        }

        //Solicitudes Completadas
        if ($request->data_set == 2) {

            $solicitudes = Solicitud::whereBetween('created_at', [$startDate, $endDate])
                        ->where('id_tecnico', Auth::user()->perfilTecnico->id_perfil)
                        ->where('cumplimiento', true)
                        ->get();
            $pdf = FacadePdf::loadView('reportes.solicitudes', compact('solicitudes', 'startDate', 'endDate'));              
        }

        //Dispositivos Registrados
        if ($request->data_set == 3) {

            $id_institucion = Solicitud::where('id_tecnico', Auth::user()->perfilTecnico->id_perfil)->pluck('id_perfil');
            $id_lab = Laboratorio::whereIn('id_perfil', $id_institucion)->pluck('id_lab');
            $dispositivos = Dispositivo::whereBetween('created_at', [$startDate, $endDate])
                                        ->whereIn('id_lab', $id_lab)
                                        ->get();

            $pdf = FacadePdf::loadView('reportes.tecnico.dispositivos', compact('dispositivos', 'startDate', 'endDate'));              
        }

        //Diagnosticos Registrados
        if ($request->data_set == 4) {

            $id_institucion = Solicitud::where('id_tecnico', Auth::user()->perfilTecnico->id_perfil)->pluck('id_perfil');
            $id_lab = Laboratorio::whereIn('id_perfil', $id_institucion)->pluck('id_lab');
            $id_pc = Dispositivo::whereIn('id_lab',$id_lab)->pluck('id_pc');

            $diagnosticos = Diagnostico::whereBetween('created_at', [$startDate, $endDate])
                                        ->whereIn('id_pc', $id_pc)
                                        ->get(); 
            $pdf = FacadePdf::loadView('reportes.tecnico.diagnosticos', compact('diagnosticos', 'startDate', 'endDate'));              
        }

        //Mantenimientos Realizados
        if ($request->data_set == 5) {

            $id_institucion = Solicitud::where('id_tecnico', Auth::user()->perfilTecnico->id_perfil)->pluck('id_perfil');
            $id_lab = Laboratorio::whereIn('id_perfil', $id_institucion)->pluck('id_lab');
            $id_pc = Dispositivo::whereIn('id_lab',$id_lab)->pluck('id_pc');
            $id_diag = Diagnostico::whereIn('id_pc',$id_pc)->pluck('id_diag');
                                        
            $mantenimientos = Mantenimiento::whereBetween('created_at', [$startDate, $endDate])
                        ->whereIn('id_diag', $id_diag)
                        ->get(); 

            $pdf = FacadePdf::loadView('reportes.tecnico.mantenimientos', compact('mantenimientos', 'startDate', 'endDate'));              
        }

        return $pdf->stream('reporteTecnico.pdf');
    }

    public function reporteInstitucion(Request $request)
    {
        // Validar las fechas recibidas
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Obtener las fechas
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $idperfil = PerfilInstitucion::where('user_id', Auth::id())->pluck('id_perfil');

        $solicitudes = Solicitud::with('perfilTecnico')->whereBetween('created_at', [$startDate, $endDate])
                    ->whereIn('id_perfil', $idperfil)
                    ->get();

        if ($request->data_set == 2) {

            $solicitudes = $solicitudes->where('estado_soli', 'aprobado');
                   
        }
        if ($request->data_set == 3) {

            $solicitudes = $solicitudes->where('estado_soli', 'rechazado');
                   
        }
        if ($request->data_set == 4) {

            $solicitudes = $solicitudes->where('estado_soli', 'procesando');
                   
        }
        
        $pdf = FacadePdf::loadView('reportes.institucion.solicitudes', compact('solicitudes', 'startDate', 'endDate'));
        

        return $pdf->stream('reporteUsuario.pdf');
    }
}
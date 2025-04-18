<?php

namespace App\Http\Controllers;

use App\Models\PerfilInstitucion;
use App\Models\PerfilTecnico;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
            //notificaciones admin
            $solicitudCount = Solicitud::whereNull('id_tecnico')->where('estado_soli','procesando')->count();
            $tecnicoCount = User::where('tipo_usuario', 'tecnico')->where('is_approved', false)->count();
            $instCount = User::where('tipo_usuario', 'institucion')->where('is_approved', false)->count();

            //notificaciones técnico
            $perfilTecnico = PerfilTecnico::where('user_id', Auth::id())->first();
            if ($perfilTecnico) {
                $soliAsig = Solicitud::where('id_tecnico', $perfilTecnico->id_perfil)->count();
            } else {
                $soliAsig = 0; 
            }
            //notificaciones institucion
            $perfilInstitucion = PerfilInstitucion::where('user_id', Auth::id())->first();
            if ($perfilInstitucion) {
                $solicitudAcep = Solicitud::where('id_perfil', $perfilInstitucion->id_perfil)->where('estado_soli','aprobado')->where('cumplimiento',false)->count();
            } else {
                $solicitudAcep = 0;
            }
            
            $conteos = [
                'solicitudes' => $solicitudCount,
                'tecnicos' => $tecnicoCount,
                'instituciones' => $instCount,
                'solicitudAsig' => $soliAsig,
                'solicitudAcep' => $solicitudAcep,
            ];
            
            // for ($i=0; $i <= 10000; $i++) { 
            //     int x = 1 + 1;
            // }

             return view('dashboard', compact('conteos'));
    }
}

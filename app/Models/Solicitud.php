<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';
    protected $primaryKey = 'id_soli';
    protected $fillable = ['id_perfil','asunto','detalles_soli','estado_soli','fecha_aceptacion','id_tecnico'];

    // Relación con perfil_institucion
    public function perfilInstitucion()
    {
        return $this->belongsTo(PerfilInstitucion::class, 'id_perfil');
    }

    // Relación con perfil_tecnico
    public function perfilTecnico()
    {
        return $this->belongsTo(PerfilTecnico::class, 'id_tecnico','id_perfil');
    }
}

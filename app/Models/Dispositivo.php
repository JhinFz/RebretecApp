<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    use HasFactory;

    protected $table = 'dispositivos';
    protected $primaryKey = 'id_pc';
    protected $fillable = ['name_lab','ubicacion_lab','cant_pc','d_internet','detalles_lab','id_perfil'];

    public function perfilInstitucion()
    {
        return $this->belongsTo(PerfilInstitucion::class, 'id_perfil','id_perfil');  //clave foranea, id tabla
    }
}

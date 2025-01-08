<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    use HasFactory;

    protected $table = 'laboratorios';
    protected $primaryKey = 'id_lab';
    protected $fillable = ['name_lab','ubicacion_lab','cant_pc','d_internet','detalles_lab','id_perfil'];

    public function perfilInstitucion()
    {
        return $this->belongsTo(PerfilInstitucion::class, 'id_perfil','id_perfil');
    }

    public function dispositivo()
    {
        return $this->hasMany(Dispositivo::class, 'id_lab', 'id_lab');
    }
}

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

    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class, 'id_lab','id_lab');  //clave foranea, id tabla
    }

    public function diagnostico()
    {
        return $this->hasOne(Mantenimiento::class, 'id_diag', 'id_diag');
    }
}

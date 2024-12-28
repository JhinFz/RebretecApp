<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilInstitucion extends Model
{
    use HasFactory;

    protected $table = 'perfil_institucion';
    protected $primaryKey = 'id_perfil';
    protected $fillable = ['user_id','instname','cod_amie','telefono','direccion'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function laboratorio()
    {
        return $this->hasOne(Laboratorio::class, 'id_perfil', 'id_perfil');
    }
}

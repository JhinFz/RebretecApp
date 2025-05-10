<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfilTecnico extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'perfil_tecnico';
    protected $primaryKey = 'id_perfil';
    protected $fillable = ['user_id','instname','telefono'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function solicitud()
    {
        return $this->hasOne(Solicitud::class, 'id_tecnico', 'id_perfil');
    }
}

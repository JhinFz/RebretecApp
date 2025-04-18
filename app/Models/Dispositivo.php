<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dispositivo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dispositivos';
    protected $primaryKey = 'id_pc';
    protected $fillable = ['id_lab','name_pc','marca','modelo','serie'];

    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class, 'id_lab','id_lab');  //clave foranea, id tabla
    }

    public function diagnosticos()
    {
        return $this->hasMany(Diagnostico::class, 'id_pc', 'id_pc');
    }
}

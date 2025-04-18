<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnostico extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'diagnosticos';
    protected $primaryKey = 'id_diag';
    protected $fillable = [
        'id_pc',
        'nombre_diag',
        'diagnostico_detail',
    ];

    
    public function dispositivo()
    {
        return $this->belongsTo(Dispositivo::class, 'id_pc', 'id_pc');
    }

    public function mantenimiento()
    {
        return $this->hasOne(Mantenimiento::class, 'id_diag', 'id_diag');
    }
}
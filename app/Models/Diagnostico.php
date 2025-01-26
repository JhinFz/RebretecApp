<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;

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
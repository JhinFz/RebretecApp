<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $table = 'mantenimientos';
    protected $primaryKey = 'id_mant';
    protected $fillable = [
        'id_diag',
        'actividades',
        'estado_mant',
    ];
    
    public function diagnosticos()
    {
        return $this->belongsTo(Diagnostico::class, 'id_diag','id_diag');
    }
}

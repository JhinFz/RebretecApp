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
        'diagnostico_detail',
        'estado',
        'msg_admin'
    ];

    
    public function dispositivo()
    {
        return $this->belongsTo(Dispositivo::class, 'id_pc');
    }
}

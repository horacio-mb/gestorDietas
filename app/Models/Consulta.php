<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table='consulta';
    protected $fillable=[
        'fecha',
        'fecha_reconsulta',
        'id_cliente',
        'id_usuario',
    ];
    public $timestamps=false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichaMedica extends Model
{
    protected $table='ficha_medica';
    protected $fillable=[
        'pesoInicial',
        'pesoActual',
        'alturaInicial',
        'alturaActual',
        'imc',
        'id_consulta',
    ];
    public $timestamps=false;
}

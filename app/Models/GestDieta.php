<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestDieta extends Model
{
    protected $table='gest_dieta';
    protected $fillable=[
        'idFichaMedica',
        'fechaInicio',
        'fechaFinal',
        'tipo',
    ];
    public $timestamps=false;
}

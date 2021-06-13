<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestRutina extends Model
{
    protected $table='gest_rutina';
    protected $fillable=[
        'idFichaMedica',
        'fechaInicio',
        'fechaFinal',
        'tipo',
    ];
    public $timestamps=false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutinaEjercicio extends Model
{
    protected $table="rutina_ejercicio";
    protected $fillable=[
        'idDiaRutina',
        'idEjercicio',
        'repeticiones',
        'ronda',
    ];
    public $timestamps=false;
}

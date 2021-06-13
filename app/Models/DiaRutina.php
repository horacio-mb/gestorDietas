<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaRutina extends Model
{
    protected $table='dia_rutina';
    protected $fillable=[
        'diaSemana',
        'idGestRutina',
    ];
    public $timestamps=false;
    public function gest_rutinas(){
        return $this->belongsTo(GestRutina::class,'idGestRutina');
    }
}

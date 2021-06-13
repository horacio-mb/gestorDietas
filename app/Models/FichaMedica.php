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
    public function consultas(){
        return $this->belongsTo(Consulta::class,'id_consulta');
    }
    public function cuestionario(){
        return $this->hasOne(Cuestionario::class);
    }
    public function ges_dietas(){
        return $this->hasMany(GestDieta::class);
    }
    public function gest_rutinas(){
        return $this->hasMany(GestRutina::class);
    }
}

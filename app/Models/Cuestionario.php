<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuestionario extends Model
{
    protected $table='cuestionario';
    protected $fillable=[
        'enfermedadBase',
        'anteFamiliares',
        'consumoAlcohol',
        'consumoTabaco',
        'consumoCafe',
        'consumoMedicamentos',
        'comidasDia',
        'actividadFisica',
        'id_fichaMedica',
    ];
    public $timestamps=false;
    public function ficha_medica(){
        return $this->belongsTo(FichaMedica::class,'id_fichaMedica');
    }
}

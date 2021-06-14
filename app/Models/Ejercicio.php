<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    protected $table="ejercicio";
    protected $fillable=[
        'nombre',
        'descripcion',
        'idTipoEjercicio',
    ];
    public $timestamps=false;
    public function tipoejercicio(){
        return $this->belongsTo(TipoEjercicio::class,'idTipoEjercicio');
    }
}

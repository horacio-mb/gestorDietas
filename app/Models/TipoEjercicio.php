<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEjercicio extends Model
{
    protected $table="tipo_ejercicio";
    protected $fillable=[
        'nombre'
    ];
    public $timestamps=false;
    public function ejercicios(){
        return $this->hasMany(Ejercicio::class);
    }
}

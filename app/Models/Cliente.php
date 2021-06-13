<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cliente extends Model
{
    protected $table='cliente';
    protected $fillable=[
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'correo',
        'telefono',
        'sexo',
    ];
    public $timestamps=false;
    public function dietas(){
        return $this->hasMany('App\Models\Dieta');
    }
}

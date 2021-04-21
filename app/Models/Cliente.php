<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cliente extends Model
{
    protected $table='cliente';
    protected $fillable=[
        'nombre',
        'apellidos',
        'correo',
        'telefono'
    ];
    public $timestamps=false;
    public function dietas(){
        return $this->hasMany('App\Models\Dieta');
    }
}

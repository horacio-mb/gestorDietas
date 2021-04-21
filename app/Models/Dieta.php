<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dieta extends Model
{
    protected $table="dieta";
    protected $fillable=[
        'nombre',
        'fechaInicio',
        'fechaFinal',
        'id_cliente'
    ];
    public $timestamps=false;
    public function cliente(){
        return $this->belongsTo('App\Models\Cliente');
    }
}

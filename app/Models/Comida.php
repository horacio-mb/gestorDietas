<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comida extends Model
{
    protected $table="comida";
    protected $fillable=[
        'descripcion',
        'id_tipo_comida'
    ];
    public $timestamps=false;
    public function tipocomida(){
        return $this->belongsTo('App\Models\TipoComida');
    }

}

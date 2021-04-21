<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoComida extends Model
{
    protected $table="tipo_comida";
    protected $fillable=[
        'nombre'
    ];
    public $timestamps=false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaDieta extends Model
{
    protected $table='dia_dieta';
    protected $fillable=[
        'diaSemana',
        'idGestDieta',
    ];
    public $timestamps=false;
    public function gest_dietas(){
        return $this->belongsTo(GestDieta::class,'idGestDieta');
    }
}

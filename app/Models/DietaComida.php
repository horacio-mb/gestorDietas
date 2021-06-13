<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietaComida extends Model
{
    protected $table="dieta_comida";
    protected $fillable=[
        'id_dia_dieta',
        'id_comida',
        'porcion',
        'cantidad',
    ];
    public $timestamps=false;
    public function dia_dietas(){
        return $this->belongsTo(DiaDieta::class,'id_dia_dieta');
    }
}

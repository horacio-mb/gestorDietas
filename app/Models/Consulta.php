<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table='consulta';
    protected $fillable=[
        'fecha',
        'fecha_reconsulta',
        'id_cliente',
        'id_usuario',
    ];
    public $timestamps=false;
    public function clientes(){
        return $this->belongsTo(Cliente::class,'id_cliente');
    }
    public function usuarios(){
        return $this->belongsTo(User::class,'id_usuario');
    }
    public function ficha_medicas(){
        return $this->hasMany(FichaMedica::class);
    }
}

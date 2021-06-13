<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestDieta;

class GestDietaController extends Controller
{
    
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        if($buscar==''){
            $resultado = GestDieta::join('ficha_medica','gest_dieta.idFichaMedica','=','ficha_medica.id')
            ->select('gest_dieta.id','gest_dieta.idFichaMedica','gest_dieta.fechaInicio','gest_dieta.fechaFinal','gest_dieta.tipo')
            ->orderBy('gest_dieta.id','desc')
            ->get();
        }
        else{
            $resultado = GestDieta::join('ficha_medica','gest_dieta.idFichaMedica','=','ficha_medica.id')
            ->select('gest_dieta.id','gest_dieta.idFichaMedica','gest_dieta.fechaInicio','gest_dieta.fechaFinal','gest_dieta.tipo')
            ->where('gest_dieta.tipo','like','%'.$buscar.'%')
            ->orderBy('gest_dieta.id','desc')
            ->get();
        }
        return $resultado;
    }

    
    public function store(Request $request)
    {
        $gest_dieta= new GestDieta();
        $gest_dieta->idFichaMedica=$request->idFichaMedica;
        $gest_dieta->fechaInicio=$request->fechaInicio;
        $gest_dieta->fechaFinal=$request->fechaFinal;
        $gest_dieta->tipo=$request->tipo;
        $gest_dieta->save();
    }


    public function update(Request $request, $id)
    {
        $gest_dieta= GestDieta::findOrFail($request->id);
        $gest_dieta->idFichaMedica=$request->idFichaMedica;
        $gest_dieta->fechaInicio=$request->fechaInicio;
        $gest_dieta->fechaFinal=$request->fechaFinal;
        $gest_dieta->tipo=$request->tipo;
        $gest_dieta->save();
    }

    public function delete(Request $request)
    {
        $gest_dieta= GestDieta::findOrFail($request->id);
        $gest_dieta->delete();
    }

    public function selectGestDieta(Request $request){
        $buscar=$request->buscar;
        if($buscar==''){
            $resultado = GestDieta::join('ficha_medica','gest_dieta.idFichaMedica','=','ficha_medica.id')
            ->select('gest_dieta.id','gest_dieta.idFichaMedica','gest_dieta.fechaInicio','gest_dieta.fechaFinal','gest_dieta.tipo')
            ->orderBy('gest_dieta.id','desc')
            ->get();
        }
        else{
            $resultado = GestDieta::join('ficha_medica','gest_dieta.idFichaMedica','=','ficha_medica.id')
            ->select('gest_dieta.id','gest_dieta.idFichaMedica','gest_dieta.fechaInicio','gest_dieta.fechaFinal','gest_dieta.tipo')
            ->where('gest_dieta.tipo','like','%'.$buscar.'%')
            ->orderBy('gest_dieta.id','desc')
            ->get();
        }
        return $resultado;        
    }
}

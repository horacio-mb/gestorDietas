<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\GestRutina;

class GestRutinaController extends Controller
{
    
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        if($buscar==''){
            $resultado = GestRutina::join('ficha_medica','gest_rutina.idFichaMedica','=','ficha_medica.id')
            ->select('gest_rutina.id','gest_rutina.idFichaMedica','gest_rutina.fechaInicio','gest_rutina.fechaFinal','gest_rutina.tipo')
            ->orderBy('gest_rutina.id','desc')
            ->get();
        }
        else{
            $resultado = GestRutina::join('ficha_medica','gest_rutina.idFichaMedica','=','ficha_medica.id')
            ->select('gest_rutina.id','gest_rutina.idFichaMedica','gest_rutina.fechaInicio','gest_rutina.fechaFinal','gest_rutina.tipo')
            ->where('gest_rutina.tipo','like','%'.$buscar.'%')
            ->orderBy('gest_rutina.id','desc')
            ->get();
        }
        return $resultado;
    }

    public function store(Request $request)
    {
        $gest_rutina= new GestRutina();
        $gest_rutina->idFichaMedica=$request->idFichaMedica;
        $gest_rutina->fechaInicio=$request->fechaInicio;
        $gest_rutina->fechaFinal=$request->fechaFinal;
        $gest_rutina->tipo=$request->tipo;
        $gest_rutina->save();
    }

    public function update(Request $request, $id)
    {
        $gest_rutina= GestRutina::findOrFail($request->id);
        $gest_rutina->idFichaMedica=$request->idFichaMedica;
        $gest_rutina->fechaInicio=$request->fechaInicio;
        $gest_rutina->fechaFinal=$request->fechaFinal;
        $gest_rutina->tipo=$request->tipo;
        $gest_rutina->save();
    }


    public function delete(Request $request)
    {
        $gest_rutina= GestRutina::findOrFail($request->id);
        $gest_rutina->delete();
    }

    public function selectGestRutina(Request $request){
        $buscar=$request->buscar;
        if($buscar==''){
            $resultado = GestRutina::join('ficha_medica','gest_rutina.idFichaMedica','=','ficha_medica.id')
            ->select('gest_rutina.id','gest_rutina.idFichaMedica','gest_rutina.fechaInicio','gest_rutina.fechaFinal','gest_rutina.tipo')
            ->orderBy('gest_rutina.id','desc')
            ->get();
        }
        else{
            $resultado = GestRutina::join('ficha_medica','gest_rutina.idFichaMedica','=','ficha_medica.id')
            ->select('gest_rutina.id','gest_rutina.idFichaMedica','gest_rutina.fechaInicio','gest_rutina.fechaFinal','gest_rutina.tipo')
            ->where('gest_rutina.tipo','like','%'.$buscar.'%')
            ->orderBy('gest_rutina.id','desc')
            ->get();
        }
        return $resultado;        
    }
}

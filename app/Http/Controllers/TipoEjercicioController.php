<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoEjercicio;

class TipoEjercicioController extends Controller
{
    public function index(Request $request)
    {
        $buscar= $request->buscar;
        if($buscar==''){
            $tipo_ejercicio = TipoEjercicio::all();
        }
        else{
            $tipo_ejercicio= TipoEjercicio::where('nombre', 'like', '%'.$buscar.'%')->get();
        }
        return $tipo_ejercicio;
    }

    public function store(Request $request)
    {
        $tipo_ejercicio=new TipoEjercicio();
        $tipo_ejercicio->nombre=$request->nombre;
        $tipo_ejercicio->save();
    }

    public function selectTipoEjercicio(){
        $tipo_ejercicio= TipoEjercicio::select('id','nombre')->get();
        return $tipo_ejercicio;
    }
    public function update(Request $request)
    {
        $tipoejercicio= TipoEjercicio::findOrFail($request->id);
        $tipoejercicio->nombre=$request->nombre;
        $tipoejercicio->save();
    }


    public function delete(Request $request)
    {
        $tipoejercicio = TipoEjercicio::findOrFail($request->id);
        $tipoejercicio->delete();
    }
    public function selectEjercicio(Request $request){
        $buscar=$request->buscar;
        if($buscar==''){
            $ejercicio =TipoEjercicio::join('ejercicio','tipo_ejercicio.id_tipo_ejercicio','=','ejercicio.idTipoEjercicio')
            ->select('tipo_ejercicio.id','tipo_ejercicio.nombre',)
            ->get();
        }
        else{
            $ejercicio =TipoEjercicio::join('ejercicio','tipo_ejercicio.id_tipo_ejercicio','=','ejercicio.idTipoEjercicio')
            ->select('tipo_ejercicio.id','tipo_ejercicio.nombre')
            ->where('nombre','like','%'.$buscar.'%')
            ->get();
        }
        return $ejercicio;        
    }
    
}

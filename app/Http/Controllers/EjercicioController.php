<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ejercicio;

class EjercicioController extends Controller
{
    
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        if($buscar==''){
            $resultado =Ejercicio::join('tipo_ejercicio','ejercicio.idTipoEjercicio','=','tipo_ejercicio.id')
            ->select('ejercicio.id','ejercicio.nombre','ejercicio.descripcion','ejercicio.idTipoEjercicio', 'tipo_ejercicio.nombre as nom_tipo_ejercicio')
            ->get();
        }
        else{
            $resultado =Ejercicio::join('tipo_ejercicio','ejercicio.idTipoEjercicio','=','tipo_ejercicio.id')
            ->select('ejercicio.id', 'ejercicio.nombre','ejercicio.descripcion' ,'ejercicio.idTipoEjercicio', 'tipo_ejercicio.nombre as nom_tipo_ejercicio')
            ->where('ejercicio.nombre','like','%'.$buscar.'%')
            ->get();
        }
        return $resultado;
    }

    
    public function store(Request $request)
    {
        $ejercicio = new Ejercicio;
        $ejercicio->nombre=$request->nombre;
        $ejercicio->descripcion=$request->descripcion;
        $ejercicio->idTipoEjercicio=$request->idTipoEjercicio;
        $ejercicio->save();
    }

    
   
    public function update(Request $request)
    {
        $ejercicio = Ejercicio::findOrFail($request->id);
        $ejercicio->nombre=$request->nombre;
        $ejercicio->descripcion=$request->descripcion;
        $ejercicio->idTipoEjercicio=$request->idTipoEjercicio;
        $ejercicio->save();
    }

    
    public function delete(Request $request)
    {
        $ejercicio = Ejercicio::findOrFail($request->id);
        $ejercicio->delete();
    }

    public function selectEjercicio(Request $request){
        $buscar=$request->buscar;
        if($buscar==''){
            $ejercicio =Ejercicio::join('tipo_ejercicio','ejercicio.idTipoEjercicio','=','tipo_ejercicio.id')
            ->select('ejercicio.id','ejercicio.nombre','ejercicio.descripcion','ejercicio.idTipoEjercicio', 'tipo_ejercicio.nombre as nom_tipo_ejercicio')
            ->get();
        }
        else{
            $ejercicio =Ejercicio::join('tipo_ejercicio','ejercicio.idTipoEjercicio','=','tipo_ejercicio.id')
            ->select('ejercicio.id','ejercicio.nombre','ejercicio.descripcion','ejercicio.idTipoEjercicio', 'tipo_ejercicio.nombre as nom_tipo_ejercicio')
            ->where('ejercicio.nombre','like','%'.$buscar.'%')
            ->get();
        }
        return $ejercicio;        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comida;

class ComidaController extends Controller
{
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        if($buscar==''){
            $resultado =Comida::join('tipo_comida','comida.id_tipo_comida','=','tipo_comida.id')
            ->select('comida.id','comida.descripcion','comida.id_tipo_comida','tipo_comida.nombre as nom_comida')
            ->get();
        }
        else{
            $resultado =Comida::join('tipo_comida','comida.id_tipo_comida','=','tipo_comida.id')
            ->select('comida.id','comida.descripcion','comida.id_tipo_comida','tipo_comida.nombre as nom_comida')
            ->where('descripcion','like','%'.$buscar.'%')
            ->get();
        }
        return $resultado;
    }

    public function store(Request $request)
    {
        $comida = new Comida;
        $comida->descripcion=$request->descripcion;
        $comida->id_tipo_comida=$request->id_tipo_comida;
        $comida->save();
    }


    public function update(Request $request)
    {
        $comida = Comida::findOrFail($request->id);
        $comida->descripcion=$request->descripcion;
        $comida->id_tipo_comida=$request->id_tipo_comida;
        $comida->save();
    }



    public function delete(Request $request)
    {
        $comida = Comida::findOrFail($request->id);
        $comida->delete();
    }

    public function selectComida(Request $request){
        $buscar=$request->buscar;
        if($buscar==''){
            $comida =Comida::join('tipo_comida','comida.id_tipo_comida','=','tipo_comida.id')
            ->select('comida.id','comida.descripcion','comida.id_tipo_comida','tipo_comida.nombre as nom_comida')
            ->get();
        }
        else{
            $comida =Comida::join('tipo_comida','comida.id_tipo_comida','=','tipo_comida.id')
            ->select('comida.id','comida.descripcion','comida.id_tipo_comida','tipo_comida.nombre as nom_comida')
            ->where('descripcion','like','%'.$buscar.'%')
            ->get();
        }
        return $comida;        
    }
}

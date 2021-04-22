<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoComida;

class TipoComidaController extends Controller
{
    public function index(Request $request)
    {
        $buscar= $request->buscar;
        if($buscar==''){
            $tipo_comida = TipoComida::all();
        }
        else{
            $tipo_comida= TipoComida::where('nombre', 'like', '%'.$buscar.'%')->get();
        }
        return $tipo_comida;
    }

    public function store(Request $request)
    {
        $tipo_comida=new TipoComida();
        $tipo_comida->nombre=$request->nombre;
        $tipo_comida->save();
    }

    public function selectTipoComida(){
        $tipo_comida= TipoComida::select('id','nombre')->get();
        return $tipo_comida;
    }
    public function update(Request $request)
    {
        $tipocomida= TipoComida::findOrFail($request->id);
        $tipocomida->nombre=$request->nombre;
        $tipocomida->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $tipocomida = TipoComida::findOrFail($request->id);
        $tipocomida->delete();
    }
}

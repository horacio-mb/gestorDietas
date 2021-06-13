<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;

class ConsultaController extends Controller
{
    
    public function index(Request $request)
    {
        $buscar= $request->buscar;
        if($buscar==''){
            $resultado=Consulta::join('cliente','consulta.id_cliente','=','cliente.id')
            ->select('consulta.id','consulta.fecha','consulta.fecha_reconsulta','consulta.id_cliente','consulta.id_usuario','cliente.nombre as nom_cliente','cliente.apellido_paterno')
            ->orderBy('consulta.id','desc')
            ->get();
        }
        else{
            $resultado=Consulta::join('cliente','consulta.id_cliente','=','cliente.id')
            ->select('consulta.id','consulta.fecha','consulta.fecha_reconsulta','consulta.id_cliente','consulta.id_usuario','cliente.nombre as nom_cliente','cliente.apellido_paterno')
            ->where('cliente.nombre','like','%'.$buscar.'%')
            ->orderBy('consulta.id','desc')
            ->get();
        }
        return $resultado;
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        $consulta = new Consulta();
        $consulta->fecha=$request->fecha;
        $consulta->fecha_reconsulta=$request->fecha_reconsulta;
        $consulta->id_cliente=$request->id_cliente;
        $consulta->id_usuario=$request->id_usuario;
        $consulta->save();

    }


    
    public function update(Request $request, $id)
    {
        $consulta= Consulta::findOrFail($request->id);
        $consulta->fecha=$request->fecha;
        $consulta->fecha_reconsulta=$request->fecha_reconsulta;
        $consulta->id_cliente=$request->id_cliente;
        $consulta->id_usuario=$request->id_usuario;
        $consulta->save();
    }

    public function delete(Request $request)
    {
        $consulta = Consulta::findOrFail($request->id);
        $consulta->delete();
    }

    public function selectConsulta(Request $request){
        $buscar=$request->buscar;
        if($buscar==''){
            $resultado=Consulta::join('cliente','consulta.id_cliente','=','cliente.id')
            ->select('consulta.id','consulta.fecha','consulta.fecha_reconsulta','consulta.id_cliente','consulta.id_usuario','cliente.nombre as nom_cliente','cliente.apellido_paterno')
            ->get();
        }
        else{
            $resultado=Consulta::join()
            ->select('consulta.id','consulta.fecha','consulta.fecha_reconsulta','consulta.id_cliente','consulta.id_usuario','cliente.nombre as nom_cliente','cliente.apellido_paterno')
            ->where('cliente.nombre','like','%'.$buscar.'%')
            ->get();
        }
        return $resultado;        
    }
}

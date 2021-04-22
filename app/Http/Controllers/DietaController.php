<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dieta;
use App\Models\DietaComida;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException; 

class DietaController extends Controller
{
    
    public function index(Request $request){
        $buscar = $request->buscar;
        if($buscar==''){
            $dieta = Dieta::join('cliente','dieta.id_cliente', '=', 'cliente.id')
            ->select('dieta.id','dieta.nombre','dieta.fechaInicio','dieta.fechaFinal','cliente.nombre as nombreC','cliente.apellidos')
            ->orderBy('dieta.id','desc')
            ->get();
        }
        else{
            $dieta = Dieta::join('cliente','dieta.id_cliente', '=', 'cliente.id')
            ->select('dieta.id','dieta.nombre','dieta.fechaInicio','dieta.fechaFinal','cliente.nombre as nombreC','cliente.apellidos')
            ->where('cliente.nombre','like','%'.$buscar.'%')
            ->orderBy('dieta.id','desc')
            ->get();
        }
        return $dieta;
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();

            $dieta = new Dieta;
            $dieta->nombre=$request->nombre;
            $dieta->fechaInicio=$request->fechaInicio;
            $dieta->fechaFinal=$request->fechaFinal;
            $dieta->id_cliente=$request->id_cliente;
            $dieta->save();

            $detalles = $request->data;
            foreach($detalles as $ep=>$det){
                $detalle = new DietaComida();
                $detalle->id_dieta=$dieta->id;
                $detalle->id_comida=$det['id_comida'];
                $detalle->distribucion=$det['distribucion'];
                $detalle->save();
            }
            DB::commit();
            return[
                'id'=>$dieta->id
            ];
        } catch (ModelNotFoundException $exception){
            DB::rollBack();
        }
    }

    public function update(Request $request){
        try{
            DB::beginTransaction();

            $dieta = Dieta::findOrFail($request->id);
            $dieta->nombre=$request->nombre;
            $dieta->fechaInicio=$request->fechaInicio;
            $dieta->fechaFinal=$request->fechaFinal;
            $dieta->fechaFinal=$request->id_cliente;
            $dieta->save();

            $detalles = $request->data;
            foreach($detalles as $ep=>$det){
                $detalle = new DietaComida();
                $detalle->id_dieta=$dieta->id;
                $detalle->id_comida=$det['id_comida'];
                $detalle->distribucion=$det['distribucion'];
                $detalle->save();
            }
            DB::commit();
            return[
                'id'=>$dieta->id
            ];
        } catch (ModelNotFoundException $exception){
            DB::rollBack();
        }
    }

    public function delete(Request $request){
        $dieta = Dieta::findOrFail($request->id);
        $dieta->save();
    }
    public function obtenerDetalles(Request $request){
        $id=$request->id;
        $detalle = DietaComida::where('dieta_comida.id_dieta','=',$id)
        ->with('comida')
        ->get();
        return ['detalle'=>$detalle];
    }

    public function obtenerCabecera(Request $request){
        $id=$request->id;
        $dieta= Dieta::join('cliente','dieta.id_cliente', '=', 'cliente.id')
        ->select('dieta.id','dieta.nombre','dieta.fechaInicio','dieta.fechaFinal','cliente.nombre as nombrec','cliente.apellidos', 'dieta.id_cliente')
        ->Find($id);
        return ['dieta'=>$dieta];
    }

    public function eliminarDetalle(Request $request){
        $id=$request->id;
        $detalle = DietaComida::where('dieta_comida.id_dieta','=',$id);
        $detalle->delete();
    }
    public function obtenerDetalles2(Request $request){
        $id=$request->id;
        $detalle = DietaComida::join('comida','dieta_comida.id_comida','=','comida.id')
        ->select('dieta_comida.distribucion','dieta_comida.id_comida', 'comida.descripcion as comida','comida.id_tipo_comida as nomC')
        ->where('dieta_comida.id_dieta','=',$id)
        ->get();
        return['detalle' => $detalle];
    }
}

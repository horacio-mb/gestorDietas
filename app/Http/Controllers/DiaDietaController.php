<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiaDieta;
use App\Models\DietaComida;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DiaDietaController extends Controller
{
    
    public function index(Request $request){
        $buscar = $request->buscar;
        if($buscar==''){
            $dia_dieta = DiaDieta::join('gest_dieta','dia_dieta.idGestDieta', '=', 'gest_dieta.id')
            ->select('dia_dieta.id','dia_dieta.diaSemana','dia_dieta.idGestDieta','gest_dieta.tipo as tipo_dieta','gest_dieta.fechaInicio as fecha_inicio','gest_dieta.fechaFinal as fecha_final')
            ->orderBy('dia_dieta.id','desc')
            ->get();
        }
        else{
            $dia_dieta = DiaDieta::join('gest_dieta','dia_dieta.idGestDieta', '=', 'gest_dieta.id')
            ->select('dia_dieta.id','dia_dieta.diaSemana','dia_dieta.idGestDieta','gest_dieta.tipo as tipo_dieta','gest_dieta.fechaInicio as fecha_inicio','gest_dieta.fechaFinal as fecha_final')
            ->where('gest_dieta.tipo','like','%'.$buscar.'%')
            ->orderBy('dia_dieta.id','desc')
            ->get();
        }
        return $dia_dieta;
    }



    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

            $dia_dieta = new DiaDieta();
            $dia_dieta->diaSemana=$request->diaSemana;
            $dia_dieta->idGestDieta=$request->idGestDieta;
            $dia_dieta->save();

            $detalles = $request->data;
            foreach($detalles as $ep=>$det){
                $detalle = new DietaComida();
                $detalle->id_dia_dieta=$dia_dieta->id;
                $detalle->id_comida=$det['id_comida'];
                $detalle->porcion=$det['porcion'];
                $detalle->cantidad=$det['cantidad'];
                $detalle->save();
            }
            DB::commit();
            return[
                'id'=>$dia_dieta->id
            ];
        } catch (ModelNotFoundException $exception){
            DB::rollBack();
        }
    }



    public function update(Request $request){
        try{
            DB::beginTransaction();

            $dia_dieta = DiaDieta::findOrFail($request->id);
            $dia_dieta->diaSemana=$request->diaSemana;
            $dia_dieta->idGestDieta=$request->idGestDieta;
            $dia_dieta->save();

            $detalles = $request->data;
            foreach($detalles as $ep=>$det){
                $detalle = new DietaComida();
                $detalle->id_dia_dieta=$dia_dieta->id;
                $detalle->id_comida=$det['id_comida'];
                $detalle->porcion=$det['porcion'];
                $detalle->cantidad=$det['cantidad'];
                $detalle->save();
            }
            DB::commit();
            return[
                'id'=>$dia_dieta->id
            ];
        } catch (ModelNotFoundException $exception){
            DB::rollBack();
        }
    }


    public function delete(Request $request){
        $id=$request->id;
        $dia=$request->dia;
        $dia_dieta= DiaDieta::join('dieta_comida','dia_dieta.id', '=', 'dieta_comida.id_dia_dieta');
        $dia_dieta->delete();
    }

    public function obtenerDetalles(Request $request){
        $id=$request->id;
        $detalle = DietaComida::where('dieta_comida.id_dia_dieta','=',$id)
        ->with('comida')
        ->get();
        return ['detalle'=>$detalle];
    }

    public function obtenerCabecera(Request $request){
        $id=$request->id;
        $dia_dieta= DiaDieta::join('gest_dieta','dia_dieta.idGestDieta', '=', 'gest_dieta.id')
        ->select('dia_dieta.id','dia_dieta.diaSemana','dia_dieta.idGestDieta','gest_dieta.tipo as tipo_dieta','gest_dieta.fechaInicio as fecha_inicio','gest_dieta.fechaFinal as fecha_final')
        ->Find($id);
        return ['dia_dieta'=>$dia_dieta];
    }
    public function eliminarDetalle(Request $request){
        $id=$request->id;
        $dia=$request->dia;
        $detalle = DietaComida::where('dieta_comida.id_dia_dieta','=',$id);
        $detalle->delete();
    }
    public function obtenerDetalles2(Request $request){
        $id=$request->id;
        $detalle = DietaComida::join('comida','dieta_comida.id_comida','=','comida.id')
        ->select('dieta_comida.porcion','dieta_comida.cantidad','dieta_comida.id_comida', 'comida.descripcion as comida','comida.id_tipo_comida as nomC')
        ->where('dieta_comida.id_dia_dieta','=',$id)
        ->get();
        return['detalle' => $detalle];
    }
}

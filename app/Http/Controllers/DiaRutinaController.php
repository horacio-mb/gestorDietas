<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiaRutina;
use App\Models\RutinaEjercicio;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException; 

class DiaRutinaController extends Controller
{
    
    public function index(Request $request){
        $buscar = $request->buscar;
        if($buscar==''){
            $dia_rutina = DiaRutina::join('gest_rutina','dia_rutina.idGestRutina', '=', 'gest_rutina.id')
            ->select('dia_rutina.id','dia_rutina.diaSemana','dia_rutina.idGestRutina','gest_rutina.tipo as tipo_rutina','gest_rutina.fechaInicio as fecha_inicio','gest_rutina.fechaFinal as fecha_final')
            ->orderBy('dia_rutina.id','desc')
            ->get();
        }
        else{
            $dia_rutina = DiaRutina::join('gest_rutina','dia_rutina.idGestRutina', '=', 'gest_rutina.id')
            ->select('dia_rutina.id','dia_rutina.diaSemana','dia_rutina.idGestRutina','gest_rutina.tipo as tipo_rutina','gest_rutina.fechaInicio as fecha_inicio','gest_rutina.fechaFinal as fecha_final')
            ->where('gest_rutina.tipo','like','%'.$buscar.'%')
            ->orderBy('dia_rutina.id','desc')
            ->get();
        }
        return $dia_rutina;
    }

    

    
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

            $dia_rutina = new DiaRutina();
            $dia_rutina->diaSemana=$request->diaSemana;
            $dia_rutina->idGestRutina=$request->idGestRutina;
            $dia_rutina->save();

            $detalles = $request->data;
            foreach($detalles as $ep=>$det){
                $detalle = new RutinaEjercicio();
                $detalle->idDiaRutina=$dia_rutina->id;
                $detalle->idEjercicio=$det['idEjercicio'];
                $detalle->repeticiones=$det['repeticiones'];
                $detalle->ronda=$det['ronda'];
                $detalle->save();
            }
            DB::commit();
            return[
                'id'=>$dia_rutina->id
            ];
        } catch (ModelNotFoundException $exception){
            DB::rollBack();
        }
    }

 
    public function update(Request $request, $id)
    {
        try{
            DB::beginTransaction();

            $dia_rutina = DiaRutina::findOrFail($request->id);
            $dia_rutina->diaSemana=$request->diaSemana;
            $dia_rutina->idGestRutina=$request->idGestRutina;
            $dia_rutina->save();

            $detalles = $request->data;
            foreach($detalles as $ep=>$det){
                $detalle = new RutinaEjercicio();
                $detalle->idDiaRutina=$dia_rutina->id;
                $detalle->idEjercicio=$det['idEjercicio'];
                $detalle->repeticiones=$det['repeticiones'];
                $detalle->ronda=$det['ronda'];
                $detalle->save();
            }
            DB::commit();
            return[
                'id'=>$dia_rutina->id
            ];
        } catch (ModelNotFoundException $exception){
            DB::rollBack();
        }
    }

   
    public function delete(Request $request){
        $dia_rutina = DiaRutina::findOrFail($request->id);
        $dia_rutina->save();
    }

    public function obtenerDetalles(Request $request){
        $id=$request->id;
        $detalle = RutinaEjercicio::where('rutina_ejercicio.idDiaRutina','=',$id)
        ->with('ejercicio')
        ->get();
        return ['detalle'=>$detalle];
    }
    public function obtenerCabecera(Request $request){
        $id=$request->id;
        $dia_rutina = DiaRutina::join('gest_rutina','dia_rutina.idGestRutina', '=', 'gest_rutina.id')
        ->select('dia_rutina.id','dia_rutina.diaSemana','dia_rutina.idGestRutina','gest_rutina.tipo as tipo_rutina','gest_rutina.fechaInicio as fecha_inicio','gest_rutina.fechaFinal as fecha_final')
        ->Find($id);
        return ['dia_dieta'=>$dia_rutina];
    }
    public function eliminarDetalle(Request $request){
        $id=$request->id;
        $detalle = RutinaEjercicio::where('rutina_ejercicio.idDiaRutina','=',$id);
        $detalle->delete();
    }
    public function obtenerDetalles2(Request $request){
        $id=$request->id;
        $detalle = RutinaEjercicio::join('ejercicio','rutina_ejercicio.idEjercicio','=','ejercicio.id')
        ->select('rutina_ejercicio.repeticiones','rutina_ejercicio.ronda','rutina_ejercicio.idEjercicio', 'ejercicio.nombre as nom_ejercicio','ejercicio.descripcion as des_ejercicio','ejercicio.idTipoEjercicio as nomE')
        ->where('rutina_ejercicio.idDiaRutina','=',$id)
        ->get();
        return['detalle' => $detalle];
    }
}

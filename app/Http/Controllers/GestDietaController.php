<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestDieta;
use App\Models\DiaDieta;
use App\Models\DietaComida;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
    //buscarNombre
    public function buscarNombre(Request $request)
    {
        $buscar = $request->buscar;
        if($buscar==''){
            $resultado = GestDieta::join('ficha_medica','gest_dieta.idFichaMedica','=','ficha_medica.id')
            ->join('consulta','ficha_medica.id_consulta','=','consulta.id')
            ->join('cliente','consulta.id_cliente','=','cliente.id')
            ->select('gest_dieta.id','gest_dieta.idFichaMedica','gest_dieta.fechaInicio','gest_dieta.fechaFinal','gest_dieta.tipo',
            'cliente.nombre as nom_cliente','cliente.apellido_paterno as apellido')
            ->orderBy('gest_dieta.id','desc')
            ->get();
        }
        else{
            $resultado = GestDieta::join('ficha_medica','gest_dieta.idFichaMedica','=','ficha_medica.id')
            ->join('consulta','ficha_medica.id_consulta','=','consulta.id')
            ->join('cliente','consulta.id_cliente','=','cliente.id')
            ->select('gest_dieta.id','gest_dieta.idFichaMedica','gest_dieta.fechaInicio','gest_dieta.fechaFinal','gest_dieta.tipo',
            'cliente.nombre as nom_cliente','cliente.apellido_paterno as apellido')
            ->where('cliente.nombre','like','%'.$buscar.'%')
            ->orderBy('gest_dieta.id','desc')
            ->get();
        }
        return $resultado;
    }
    
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $gest_dieta= new GestDieta();
            $gest_dieta->idFichaMedica=$request->idFichaMedica;
            $gest_dieta->fechaInicio=$request->fechaInicio;
            $gest_dieta->fechaFinal=$request->fechaFinal;
            $gest_dieta->tipo=$request->tipo;
            $gest_dieta->save();
            //Lunes
            $dietaLunes=$request->dataLunes;
            $lunes= new DiaDieta();
            $lunes->diaSemana='lunes';
            $lunes->idGestDieta=$gest_dieta->id;
            $lunes->save();
            foreach($dietaLunes as $ep=>$lun){
                $diaLunes= new DietaComida();
                $diaLunes->id_dia_dieta=$lunes->id;
                $diaLunes->id_comida=$lun['id_comida'];
                $diaLunes->porcion=$lun['porcion'];
                $diaLunes->cantidad=$lun['cantidad'];
                $diaLunes->save();
            }
            //Martes
            $dietaMartes=$request->dataMartes;
            $martes= new DiaDieta();
            $martes->diaSemana='martes';
            $martes->idGestDieta=$gest_dieta->id;
            $martes->save();
            foreach($dietaMartes as $ep=>$mar){
                $diaMartes= new DietaComida();
                $diaMartes->id_dia_dieta=$martes->id;
                $diaMartes->id_comida=$mar['id_comida'];
                $diaMartes->porcion=$mar['porcion'];
                $diaMartes->cantidad=$mar['cantidad'];
                $diaMartes->save();
            }
            //Miercoles
            $dietaMiercoles=$request->dataMiercoles;
            $miercoles= new DiaDieta();
            $miercoles->diaSemana='miercoles';
            $miercoles->idGestDieta=$gest_dieta->id;
            $miercoles->save();
            foreach($dietaMiercoles as $ep=>$mie){
                $diaMiercoles= new DietaComida();
                $diaMiercoles->id_dia_dieta=$miercoles->id;
                $diaMiercoles->id_comida=$mie['id_comida'];
                $diaMiercoles->porcion=$mie['porcion'];
                $diaMiercoles->cantidad=$mie['cantidad'];
                $diaMiercoles->save();
            }
            //Jueves
            $dietaJueves=$request->dataJueves;
            $jueves= new DiaDieta();
            $jueves->diaSemana='jueves';
            $jueves->idGestDieta=$gest_dieta->id;
            $jueves->save();
            foreach($dietaJueves as $ep=>$jue){
                $diaJueves= new DietaComida();
                $diaJueves->id_dia_dieta=$jueves->id;
                $diaJueves->id_comida=$jue['id_comida'];
                $diaJueves->porcion=$jue['porcion'];
                $diaJueves->cantidad=$jue['cantidad'];
                $diaJueves->save();
            }
            //Viernes
            $dietaViernes=$request->dataViernes;
            $viernes= new DiaDieta();
            $viernes->diaSemana='viernes';
            $viernes->idGestDieta=$gest_dieta->id;
            $viernes->save();
            foreach($dietaViernes as $ep=>$vie){
                $diaViernes= new DietaComida();
                $diaViernes->id_dia_dieta=$viernes->id;
                $diaViernes->id_comida=$vie['id_comida'];
                $diaViernes->porcion=$vie['porcion'];
                $diaViernes->cantidad=$vie['cantidad'];
                $diaViernes->save();
            }

            DB::commit();
            return[
                'id'=>$gest_dieta->id
            ];
        }
        catch (ModelNotFoundException $exception){
            DB::rollBack();
        }
        
    }


    public function update(Request $request, $id)
    {
        
        try{
            DB::beginTransaction();
            $gest_dieta= GestDieta::findOrFail($request->id);
            $gest_dieta->idFichaMedica=$request->idFichaMedica;
            $gest_dieta->fechaInicio=$request->fechaInicio;
            $gest_dieta->fechaFinal=$request->fechaFinal;
            $gest_dieta->tipo=$request->tipo;
            $gest_dieta->save();
            //Lunes
            $dietaLunes=$request->dataLunes;
            $lunes= new DiaDieta();
            $lunes->diaSemana='lunes';
            $lunes->idGestDieta=$gest_dieta->id;
            $lunes->save();
            foreach($dietaLunes as $ep=>$lun){
                $diaLunes= new DietaComida();
                $diaLunes->id_dia_dieta=$lunes->id;
                $diaLunes->id_comida=$lun['id_comida'];
                $diaLunes->porcion=$lun['porcion'];
                $diaLunes->cantidad=$lun['cantidad'];
                $diaLunes->save();
            }
            //Martes
            $dietaMartes=$request->dataMartes;
            $martes= new DiaDieta();
            $martes->diaSemana='martes';
            $martes->idGestDieta=$gest_dieta->id;
            $martes->save();
            foreach($dietaMartes as $ep=>$mar){
                $diaMartes= new DietaComida();
                $diaMartes->id_dia_dieta=$martes->id;
                $diaMartes->id_comida=$mar['id_comida'];
                $diaMartes->porcion=$mar['porcion'];
                $diaMartes->cantidad=$mar['cantidad'];
                $diaMartes->save();
            }
            //Miercoles
            $dietaMiercoles=$request->dataMiercoles;
            $miercoles= new DiaDieta();
            $miercoles->diaSemana='miercoles';
            $miercoles->idGestDieta=$gest_dieta->id;
            $miercoles->save();
            foreach($dietaMiercoles as $ep=>$mie){
                $diaMiercoles= new DietaComida();
                $diaMiercoles->id_dia_dieta=$miercoles->id;
                $diaMiercoles->id_comida=$mie['id_comida'];
                $diaMiercoles->porcion=$mie['porcion'];
                $diaMiercoles->cantidad=$mie['cantidad'];
                $diaMiercoles->save();
            }
            //Jueves
            $dietaJueves=$request->dataJueves;
            $jueves= new DiaDieta();
            $jueves->diaSemana='jueves';
            $jueves->idGestDieta=$gest_dieta->id;
            $jueves->save();
            foreach($dietaJueves as $ep=>$jue){
                $diaJueves= new DietaComida();
                $diaJueves->id_dia_dieta=$jueves->id;
                $diaJueves->id_comida=$jue['id_comida'];
                $diaJueves->porcion=$jue['porcion'];
                $diaJueves->cantidad=$jue['cantidad'];
                $diaJueves->save();
            }
            //Viernes
            $dietaViernes=$request->dataViernes;
            $viernes= new DiaDieta();
            $viernes->diaSemana='viernes';
            $viernes->idGestDieta=$gest_dieta->id;
            $viernes->save();
            foreach($dietaViernes as $ep=>$vie){
                $diaViernes= new DietaComida();
                $diaViernes->id_dia_dieta=$viernes->id;
                $diaViernes->id_comida=$vie['id_comida'];
                $diaViernes->porcion=$vie['porcion'];
                $diaViernes->cantidad=$vie['cantidad'];
                $diaViernes->save();
            }

            DB::commit();
            return[
                'id'=>$gest_dieta->id
            ];
        }
        catch (ModelNotFoundException $exception){
            DB::rollBack();
        }
    }
    public function eliminarDetalle(Request $request){
        $id=$request->id;
        $detalle= DietaComida::join('dieta_comida','dia_dieta.id','=','dieta_comida.id_dia_dieta')
        ->with('dieta_comida')
        ->where('dia_dieta.idGestDieta','=',$id);
        $detalle->delete();
    }
    public function obtenerCabecera(Request $request){
        $id=$request->id;
        $dia_dieta= DiaDieta::join('gest_dieta','dia_dieta.idGestDieta', '=', 'gest_dieta.id')
        ->select('dia_dieta.id','dia_dieta.diaSemana','dia_dieta.idGestDieta','gest_dieta.tipo as tipo_dieta','gest_dieta.fechaInicio as fecha_inicio','gest_dieta.fechaFinal as fecha_final')
        ->Find($id);
        return ['dia_dieta'=>$dia_dieta];
    }
    public function obtnerdia(Request $request){
        $id=$request->id;
        $dia=$request->dia;
        $dia_dieta= DiaDieta::join('dieta_comida','dia_dieta.id', '=', 'dieta_comida.id_dia_dieta')
        ->join('comida','dieta_comida.id_comida','=','comida.id')
        ->join('tipo_comida','comida.id_tipo_comida','=','tipo_comida.id')
        ->select('dia_dieta.id','dia_dieta.diaSemana','comida.descripcion as comida','comida.id','tipo_comida.nombre as distribucion','comida.kcal',
        'dieta_comida.porcion','dieta_comida.cantidad')
        ->where('dia_dieta.idGestDieta','=',$id)
        ->where('dia_dieta.diaSemana','=',$dia)->get();
        return $dia_dieta;
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

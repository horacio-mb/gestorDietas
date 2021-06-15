<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\GestRutina;
use App\Models\DiaRutina;
use App\Models\RutinaEjercicio;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
    //buscarNombre
    public function buscarNombre(Request $request)
    {
        $buscar = $request->buscar;
        if($buscar==''){
            $resultado = GestRutina::join('ficha_medica','gest_rutina.idFichaMedica','=','ficha_medica.id')
            ->join('consulta','ficha_medica.id_consulta','=','consulta.id')
            ->join('cliente','consulta.id_cliente','=','cliente.id')
            ->select('gest_rutina.id','gest_rutina.idFichaMedica','gest_rutina.fechaInicio','gest_rutina.fechaFinal','gest_rutina.tipo',
            'cliente.nombre as nom_cliente','cliente.apellido_paterno as apellido')
            ->orderBy('gest_rutina.id','desc')
            ->get();
        }
        else{
            $resultado = GestRutina::join('ficha_medica','gest_rutina.idFichaMedica','=','ficha_medica.id')
            ->join('consulta','ficha_medica.id_consulta','=','consulta.id')
            ->join('cliente','consulta.id_cliente','=','cliente.id')
            ->select('gest_rutina.id','gest_rutina.idFichaMedica','gest_rutina.fechaInicio','gest_rutina.fechaFinal','gest_rutina.tipo',
            'cliente.nombre as nom_cliente','cliente.apellido_paterno as apellido')
            ->where('gest_rutina.tipo','like','%'.$buscar.'%')
            ->orderBy('gest_rutina.id','desc')
            ->get();
        }
        return $resultado;
    }
    public function obtnerdia(Request $request){
        $id=$request->id;
        $dia=$request->dia;
        $dia_rutina= DiaRutina::join('rutina_ejercicio','dia_rutina.id', '=', 'rutina_ejercicio.idDiaRutina')
        ->join('ejercicio','rutina_ejercicio.idEjercicio','=','ejercicio.id')
        ->join('tipo_ejercicio','ejercicio.idTipoEjercicio','=','tipo_ejercicio.id')
        ->select('dia_rutina.id','dia_rutina.diaSemana','ejercicio.nombre as ejercicio','ejercicio.id','tipo_ejercicio.nombre as tipo','ejercicio.descripcion',
        'rutina_ejercicio.ronda','rutina_ejercicio.repeticiones')
        ->where('dia_rutina.idGestRutina','=',$id)
        ->where('dia_rutina.diaSemana','=',$dia)->get();
        return $dia_rutina;
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $gest_rutina= new GestRutina();
            $gest_rutina->idFichaMedica=$request->idFichaMedica;
            $gest_rutina->fechaInicio=$request->fechaInicio;
            $gest_rutina->fechaFinal=$request->fechaFinal;
            $gest_rutina->tipo=$request->tipo;
            $gest_rutina->save();
            //Lunes
            $rutinaLunes=$request->dataLunes;
            $lunes=new DiaRutina();
            $lunes->diaSemana='lunes';
            $lunes->idGestRutina=$gest_rutina->id;
            $lunes->save();
            foreach($rutinaLunes as $ep=>$lun){
                $diaLunes= new RutinaEjercicio();
                $diaLunes->idDiaRutina=$lunes->id;
                $diaLunes->idEjercicio=$lun['id_ejercicio'];
                $diaLunes->repeticiones=$lun['repeticiones'];
                $diaLunes->ronda=$lun['ronda'];
                $diaLunes->save();
            }
            //Martes
            $rutinaMartes=$request->dataMartes;
            $martes= new DiaRutina();
            $martes->diaSemana='martes';
            $martes->idGestRutina=$gest_rutina->id;
            $martes->save();
            foreach($rutinaMartes as $ep=>$mar){
                $diaMartes= new RutinaEjercicio();
                $diaMartes->idDiaRutina=$martes->id;
                $diaMartes->idEjercicio=$mar['id_ejercicio'];
                $diaMartes->repeticiones=$mar['repeticiones'];
                $diaMartes->ronda=$mar['ronda'];
                $diaMartes->save();
            }
            //Miercoles
            $rutinaMiercoles=$request->dataMiercoles;
            $miercoles= new DiaRutina();
            $miercoles->diaSemana='miercoles';
            $miercoles->idGestRutina=$gest_rutina->id;
            $miercoles->save();
            foreach($rutinaMiercoles as $ep=>$mie){
                $diaMiercoles= new RutinaEjercicio();
                $diaMiercoles->idDiaRutina=$miercoles->id;
                $diaMiercoles->idEjercicio=$mie['id_ejercicio'];
                $diaMiercoles->repeticiones=$mie['repeticiones'];
                $diaMiercoles->ronda=$mie['ronda'];
                $diaMiercoles->save();
            }

            //Jueves
            $rutinaJueves=$request->dataJueves;
            $jueves= new DiaRutina();
            $jueves->diaSemana='jueves';
            $jueves->idGestRutina=$gest_rutina->id;
            $jueves->save();
            foreach($rutinaJueves as $ep=>$jue){
                $diaJueves= new RutinaEjercicio();
                $diaJueves->idDiaRutina=$jueves->id;
                $diaJueves->idEjercicio=$jue['id_ejercicio'];
                $diaJueves->repeticiones=$jue['repeticiones'];
                $diaJueves->ronda=$jue['ronda'];
                $diaJueves->save();
            }
            //Viernes
            $rutinaViernes=$request->dataViernes;
            $viernes= new DiaRutina();
            $viernes->diaSemana='viernes';
            $viernes->idGestRutina=$gest_rutina->id;
            $viernes->save();
            foreach($rutinaViernes as $ep=>$vie){
                $diaViernes= new RutinaEjercicio();
                $diaViernes->idDiaRutina=$viernes->id;
                $diaViernes->idEjercicio=$vie['id_ejercicio'];
                $diaViernes->repeticiones=$vie['repeticiones'];
                $diaViernes->ronda=$vie['ronda'];
                $diaViernes->save();
            }
            DB::commit();
            return[
                'id'=>$gest_rutina->id
            ];

        }
        catch (ModelNotFoundException $exception){
            DB::rollBack();
        }
        
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

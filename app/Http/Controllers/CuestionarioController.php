<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuestionario;

class CuestionarioController extends Controller
{
    
    public function index(Request $request)
    {
        $buscar= $request->buscar;
        if($buscar==''){
            $resultado=Cuestionario::join('ficha_medica','cuestionario.id_fichaMedica','=','ficha_medica.id')
            ->join('consulta','ficha_medica.id_consulta','=','consulta.id')
            ->join('cliente','consulta.id_cliente','=','cliente.id')
            ->select('cuestionario.id','cuestionario.enfermedadBase','cuestionario.anteFamiliares',
            'cuestionario.consumoAlcohol','cuestionario.consumoTabaco','cuestionario.consumoCafe','cuestionario.consumoMedicamentos',
            'cuestionario.comidasDia','cuestionario.actividadFisica','cuestionario.id_fichaMedica',
            'cliente.nombre as nom_cliente','cliente.apellido_paterno as apellido')
            ->orderBy('cuestionario.id','desc')
            ->get();
        }
        else{
            $resultado=Cuestionario::join('ficha_medica','cuestionario.id_fichaMedica','=','ficha_medica.id')
            ->join('consulta','ficha_medica.id_consulta','=','consulta.id')
            ->join('cliente','consulta.id_cliente','=','cliente.id')
            ->select('cuestionario.id','cuestionario.enfermedadBase','cuestionario.anteFamiliares',
            'cuestionario.consumoAlcohol','cuestionario.consumoTabaco','cuestionario.consumoCafe','cuestionario.consumoMedicamentos',
            'cuestionario.comidasDia','cuestionario.actividadFisica','cuestionario.id_fichaMedica',
            'cliente.nombre as nom_cliente','cliente.apellido_paterno as apellido')
            ->where('cliente.nombre','like','%'.$buscar.'%')
            ->orderBy('cuestionario.id','desc')
            ->get();
        }
        return $resultado;
    }

   
    public function store(Request $request)
    {
        $cuestionario= new Cuestionario();
        $cuestionario->enfermedadBase=$request->enfermedadBase;
        $cuestionario->anteFamiliares=$request->anteFamiliares;
        $cuestionario->consumoAlcohol=$request->consumoAlcohol;
        $cuestionario->consumoTabaco=$request->consumoTabaco;
        $cuestionario->consumoCafe=$request->consumoCafe;
        $cuestionario->consumoMedicamentos=$request->consumoMedicamentos;
        $cuestionario->comidasDia=$request->comidasDia;
        $cuestionario->actividadFisica=$request->actividadFisica;
        $cuestionario->id_fichaMedica=$request->id_fichaMedica;
        $cuestionario->save();
    }


    public function update(Request $request)
    {
        $cuestionario= Cuestionario::findOrFail($request->id);
        $cuestionario->enfermedadBase=$request->enfermedadBase;
        $cuestionario->anteFamiliares=$request->anteFamiliares;
        $cuestionario->consumoAlcohol=$request->consumoAlcohol;
        $cuestionario->consumoTabaco=$request->consumoTabaco;
        $cuestionario->consumoCafe=$request->consumoCafe;
        $cuestionario->consumoMedicamentos=$request->consumoMedicamentos;
        $cuestionario->comidasDia=$request->comidasDia;
        $cuestionario->actividadFisica=$request->actividadFisica;
        $cuestionario->id_fichaMedica=$request->id_fichaMedica;
        $cuestionario->save();
    }


    public function delete(Request $request)
    {
        $cuestionario= Cuestionario::findOrFail($request->id);
        $cuestionario->delete();
    }

    public function selectCuestionario(Request $request){
        $buscar=$request->buscar;
        if($buscar==''){
            $cuestionario =Cuestionario::join('ficha_medica','cuestionario.id_fichaMedica','=','ficha_medica.id')
            ->join('consulta','ficha_medica.id_consulta','=','consulta.id')
            ->join('cliente','consulta.id_cliente','=','cliente.id')
            ->select('cuestionario.id','cuestionario.enfermedadBase','cuestionario.anteFamiliares',
            'cuestionario.consumoAlcohol','cuestionario.consumoTabaco','cuestionario.consumoCafe','cuestionario.consumoMedicamentos',
            'cuestionario.comidasDia','cuestionario.actividadFisica','cuestionario.id_fichaMedica',
            'cliente.nombre as nom_cliente','cliente.apellido_paterno as apellido')
            ->orderBy('cuestionario.id','desc')
            ->get();
        }
        else{
            $cuestionario =Cuestionario::join('ficha_medica','cuestionario.id_fichaMedica','=','ficha_medica.id')
            ->join('consulta','ficha_medica.id_consulta','=','consulta.id')
            ->join('cliente','consulta.id_cliente','=','cliente.id')
            ->select('cuestionario.id','cuestionario.enfermedadBase','cuestionario.anteFamiliares',
            'cuestionario.consumoAlcohol','cuestionario.consumoTabaco','cuestionario.consumoCafe','cuestionario.consumoMedicamentos',
            'cuestionario.comidasDia','cuestionario.actividadFisica','cuestionario.id_fichaMedica',
            'cliente.nombre as nom_cliente','cliente.apellido_paterno as apellido')
            ->where('cliente.nombre','like','%'.$buscar.'%')
            ->orderBy('cuestionario.id','desc')
            ->get();
        }
        return $cuestionario;        
    }
}

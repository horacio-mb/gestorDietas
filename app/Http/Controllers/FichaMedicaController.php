<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FichaMedica;

class FichaMedicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar= $request->buscar;
        if($buscar==''){
            $resultado=FichaMedica::join('consulta','ficha_medica.id_consulta','=','consulta.id')
            ->select('ficha_medica.id','ficha_medica.pesoInicial','ficha_medica.pesoActual','ficha_medica.alturaInicial','ficha_medica.alturaActual','ficha_medica.imc','ficha_medica.id_consulta','consulta.fecha as fecha_consulta')
            ->orderBy('consulta.fecha','desc')
            ->get();
        }
        else{
            $resultado=FichaMedica::join('consulta','ficha_medica.id_consulta','=','consulta.id')
            ->select('ficha_medica.id','ficha_medica.pesoInicial','ficha_medica.pesoActual','ficha_medica.alturaInicial','ficha_medica.alturaActual','ficha_medica.imc','ficha_medica.id_consulta','consulta.fecha as fecha_consulta')
            ->where('consulta.fecha','like','%'.$buscar.'%')
            ->orderBy('ficha_medica.id','desc')
            ->get();
        }
        return $resultado;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fichamedica = new FichaMedica();
        $fichamedica->pesoInicial=$request->pesoInicial;
        $fichamedica->pesoActual=$request->pesoActual;
        $fichamedica->alturaInicial=$request->alturaInicial;
        $fichamedica->alturaActual=$request->alturaActual;
        $fichamedica->imc=(($request->pesoActual*10000)/($request->alturaActual*$request->alturaActual));
        $fichamedica->id_consulta=$request->id_consulta;
        $fichamedica->save();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fichamedica=FichaMedica::findOrFail($request->id);
        $fichamedica->pesoInicial=$request->pesoInicial;
        $fichamedica->pesoActual=$request->pesoActual;
        $fichamedica->alturaInicial=$request->alturaInicial;
        $fichamedica->alturaActual=$request->alturaActual;
        $fichamedica->imc=(($request->pesoActual*10000)/($request->alturaActual*$request->alturaActual));
        $fichamedica->id_consulta=$request->id_consulta;
        $fichamedica->save();
    }

    public function delete(Request $request)
    {
        $fichamedica = FichaMedica::findOrFail($request->id);
        $fichamedica->delete();
    }

    public function selectFicha(Request $request){
        $buscar=$request->buscar;
        if($buscar==''){
            $resultado=FichaMedica::join('consulta','ficha_medica.id_consulta','=','consulta.id')
            ->select('ficha_medica.id','ficha_medica.pesoInicial','ficha_medica.pesoActual','ficha_medica.alturaInicial','ficha_medica.alturaActual','ficha_medica.imc','ficha_medica.id_consulta','consulta.fecha as fecha_consulta')
            ->orderBy('consulta.fecha','desc')
            ->get();
        }
        else{
            $resultado=FichaMedica::join('consulta','ficha_medica.id_consulta','=','consulta.id')
            ->select('ficha_medica.id','ficha_medica.pesoInicial','ficha_medica.pesoActual','ficha_medica.alturaInicial','ficha_medica.alturaActual','ficha_medica.imc','ficha_medica.id_consulta','consulta.fecha as fecha_consulta')
            ->where('consulta.fecha','like','%'.$buscar.'%')
            ->orderBy('ficha_medica.id','desc')
            ->get();
        }
        return $resultado;        
    }
}

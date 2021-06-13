<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
 

class ClienteController extends Controller
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
            $cliente=Cliente::all();
        }
        else{
            $cliente=Cliente::where('nombre','like','%'.$buscar.'%')
            ->get();
        }
        return $cliente;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $cliente = new Cliente;
        $cliente->nombre=$request->nombre;
        $cliente->apellido_paterno=$request->apellido_paterno;
        $cliente->apellido_materno=$request->apellido_materno;
        $cliente->fecha_nacimiento=$request->fecha_nacimiento;
        $cliente->correo=$request->correo;
        $cliente->telefono=$request->telefono;
        $cliente->sexo=$request->sexo;
        $cliente->save();

    }
    public function update(Request $request){
        $cliente = Cliente::findOrFail($request->id);
        $cliente->nombre=$request->nombre;
        $cliente->apellido_paterno=$request->apellido_paterno;
        $cliente->apellido_materno=$request->apellido_materno;
        $cliente->fecha_nacimiento=$request->fecha_nacimiento;
        $cliente->correo=$request->correo;
        $cliente->telefono=$request->telefono;
        $cliente->sexo=$request->sexo;
        $cliente->save();
    }
    public function delete(Request $request){
        $cliente = Cliente::findOrFail($request->id);
        $cliente->delete();
    }

    public function selectCliente(Request $request){
        $filtro = $request->filtro;
        $cliente = Cliente::where('nombre','like','%'.$filtro.'%')
        ->orWhere('correo','like','%'.$filtro.'%')
        ->select('id','nombre','apellido_paterno','apellido_materno','fecha_nacimiento','correo', 'telefono','sexo')
        ->get();
        return $cliente;
    }
}

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
        $cliente->apellidos=$request->apellidos;
        $cliente->correo=$request->correo;
        $cliente->telefono=$request->telefono;
        $cliente->save();

    }
    public function update(Request $request){
        $cliente = Cliente::findOrFail($request->id);
        $cliente->nombre=$request->nombre;
        $cliente->apellidos=$request->apellidos;
        $cliente->correo=$request->correo;
        $cliente->telefono=$request->telefono;
        $cliente->save();
    }
    public function delete(Request $request){
        $cliente = Cliente::findOrFail($request->id);
        $cliente->delete();
    }

    public function selectCliente(Request $request){
        $filtro = $request->filtro;
        $cliente = Cliente::where('nombre','like','%'.$filtro.'%')
        ->orWhere('empresa','like','%'.$filtro.'%')
        ->select('id','nombre','apellidos','empresa', 'telefono', 'direccion')
        ->get();
        return $cliente;
    }
}

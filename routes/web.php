<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ComidaController;
use App\Http\Controllers\DietaController;
use App\Http\Controllers\TipoComidaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Rutas para tipo Comida
Route::get('/tipo_comida',[TipoComidaController::class,'index']);
Route::post('/tipo_comida/registrar',[TipoComidaController::class,'store']);
Route::put('/tipo_comida/modificar',[TipoComidaController::class,'update']);
Route::put('/tipo_comida/eliminar',[TipoComidaController::class,'delete']);
Route::get('/tipo_comida/selectTipoComida',[TipoComidaController::class,'selectTipoComida']);
//Rutas para Comida
Route::get('/comida',[ComidaController::class,'index']);
Route::post('/comida/registrar',[ComidaController::class,'store']);
Route::put('/comida/modificar',[ComidaController::class,'update']);
Route::put('/comida/eliminar',[ComidaController::class,'delete']);
Route::get('/comida/selectComida',[ComidaController::class,'selectComida']);


//Rutas para Cliente
Route::get('/cliente',[ClienteController::class,'index']);
Route::post('/cliente/registrar',[ClienteController::class,'store']);
Route::put('/cliente/modificar',[ClienteController::class,'update']);
Route::put('/cliente/eliminar',[ClienteController::class,'delete']);
Route::get('/cliente/selectCliente',[ClienteController::class,'selectCliente']);

//Rutas para Dieta
Route::get('/dieta',[DietaController::class,'index']);
Route::post('/dieta/registrar',[DietaController::class,'store']);
Route::get('/dieta/obtenerDetalles',[DietaController::class,'obtenerDetalles']);
Route::get('/dieta/obtenerCabecera',[DietaController::class,'obtenerCabecera']);
Route::put('/dieta/anular',[DietaController::class,'delete']);
Route::put('/dieta/modificar',[DietaController::class,'update']);
Route::get('/dieta/obtenerDetalles2',[DietaController::class,'obtenerDetalles2']);
Route::put('/detalle/eliminar',[DietaController::class,'eliminarDetalle']);
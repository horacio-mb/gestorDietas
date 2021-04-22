<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ComidaController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
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
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClienteController;
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
//Rutas para Cliente
Route::get('/cliente',[ClienteController::class,'index']);
Route::post('/cliente/registrar',[ClienteController::class,'store']);
Route::put('/cliente/modificar',[ClienteController::class,'update']);
Route::put('/cliente/eliminar',[ClienteController::class,'delete']);
Route::get('/cliente/selectCliente',[ClienteController::class,'selectCliente']);
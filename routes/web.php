<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ClienteController;

use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\FichaMedicaController;
use App\Http\Controllers\CuestionarioController;

use App\Http\Controllers\ComidaController;
use App\Http\Controllers\TipoComidaController;
//use App\Http\Controllers\DietaController;
use App\Http\Controllers\TipoEjercicioController;
use App\Http\Controllers\EjercicioController;

use App\Http\Controllers\GestDietaController;
use App\Http\Controllers\GestRutinaController;
use App\Http\Controllers\DiaDietaController;
use App\Http\Controllers\DiaRutinaController;


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
    return view('auth/login');
});
Route::get('/casa', function () {
    return view('index');
});

Auth::routes();
Route::get('/login',[SessionController::class,'create'])->name('login.index');
Route::get('/register',[RegisterController::class,'create'])->name('register.index');

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


// Rutas para tipo Ejercicio
Route::get('/tipo_ejercicio',[TipoEjercicioController::class,'index']);
Route::post('/tipo_ejercicio/registrar',[TipoEjercicioController::class,'store']);
Route::put('/tipo_ejercicio/modificar',[TipoEjercicioController::class,'update']);
Route::put('/tipo_ejercicio/eliminar',[TipoEjercicioController::class,'delete']);
Route::get('/tipo_ejercicio/selectTipoEjercicio',[TipoEjercicioController::class,'selectTipoEjercicio']);
//Rutas para Ejercicio
Route::get('/ejercicio',[EjercicioController::class,'index']);
Route::post('/ejercicio/registrar',[EjercicioController::class,'store']);
Route::put('/ejercicio/modificar',[EjercicioController::class,'update']);
Route::put('/ejercicio/eliminar',[EjercicioController::class,'delete']);
Route::get('/ejercicio/selectEjercicio',[EjercicioController::class,'selectEjercicio']);


//Rutas para Cliente
Route::get('/cliente',[ClienteController::class,'index']);
Route::post('/cliente/registrar',[ClienteController::class,'store']);
Route::put('/cliente/modificar',[ClienteController::class,'update']);
Route::put('/cliente/eliminar',[ClienteController::class,'delete']);
Route::get('/cliente/selectCliente',[ClienteController::class,'selectCliente']);

//Rutas para Consulta
Route::get('/consulta',[ConsultaController::class,'index']);
Route::post('/consulta/registrar',[ConsultaController::class,'store']);
Route::put('/consulta/modificar',[ConsultaController::class,'update']);
Route::put('/consulta/eliminar',[ConsultaController::class,'delete']);
Route::get('/consulta/selectConsulta',[ConsultaController::class,'selectConsulta']);
Route::get('/consulta/fechas',[ConsultaController::class,'buscafecha']);
Route::get('/consulta/buscaUsuario',[ConsultaController::class,'buscaUsuario']);


//Rutas para Ficha Medica
Route::get('/fichamedica',[FichaMedicaController::class,'index']);
Route::post('/fichamedica/registrar',[FichaMedicaController::class,'store']);
Route::put('/fichamedica/modificar',[FichaMedicaController::class,'update']);
Route::put('/fichamedica/eliminar',[FichaMedicaController::class,'delete']);
Route::get('/fichamedica/selectFicha',[FichaMedicaController::class,'selectFicha']);
Route::get('/fichamedica/fechas',[FichaMedicaController::class,'buscafecha']);

//Rutas para Cuestionario
Route::get('/cuestionario',[CuestionarioController::class,'index']);
Route::post('/cuestionario/registrar',[CuestionarioController::class,'store']);
Route::put('/cuestionario/modificar',[CuestionarioController::class,'update']);
Route::put('/cuestionario/elminiar',[CuestionarioController::class,'delete']);
Route::get('/cuestionario/selectCuestionario',[CuestionarioController::class,'selectCuestionario']);

//Rutas para Gestionar Dieta
Route::get('/gestdieta',[GestDietaController::class,'index']);
Route::post('/gestdieta/registrar',[GestDietaController::class,'store']);
Route::put('/gestdieta/modificar',[GestDietaController::class,'update']);
Route::put('/gestdieta/eliminar',[GestDietaController::class,'delete']);
Route::get('/gestdieta/selectGestDieta',[GestDietaController::class,'selectGestDieta']);
Route::put('/detalle/eliminar',[GestDietaController::class,'eliminarDetalle']);
Route::get('/gestdieta/buscarnombre',[GestDietaController::class,'buscarNombre']);
Route::get('/gestdieta/obtnerdia',[GestDietaController::class,'obtnerdia']);

//Rutas para Gestionar Rutina
Route::get('/gestrutina',[GestRutinaController::class,'index']);
Route::post('/gestrutina/registrar',[GestRutinaController::class,'store']);
Route::put('/gestrutina/modificar',[GestRutinaController::class,'update']);
Route::put('/gestrutina/eliminar',[GestRutinaController::class,'delete']);
Route::get('/gestrutina/selectGestRutina',[GestRutinaController::class,'selectGestRutina']);
Route::get('/gestrutina/buscarnombre',[GestRutinaController::class,'buscarNombre']);
Route::get('/gestrutina/obtnerdia',[GestRutinaController::class,'obtnerdia']);

//Rutas para d??a dieta
Route::get('/diadieta',[DiaDietaController::class,'index']);
Route::post('/diadieta/registrar',[DiaDietaController::class,'store']);
Route::get('/diadieta/obtenerDetalles',[DiaDietaController::class,'obtenerDetalles']);
Route::get('/diadieta/obtenerCabecera',[DiaDietaController::class,'obtenerCabecera']);
Route::put('/diadieta/anular',[DiaDietaController::class,'delete']);
Route::put('/diadieta/modificar',[DiaDietaController::class,'update']);
Route::get('/diadieta/obtenerDetalles2',[DiaDietaController::class,'obtenerDetalles2']);
Route::put('/detalledieta/eliminar',[DiaDietaController::class,'eliminarDetalle']);

//Rutas para D??a Rutina
Route::get('/diarutina',[DiaRutinaController::class,'index']);
Route::post('/diarutina/registrar',[DiaRutinaController::class,'store']);
Route::get('/diarutina/obtenerDetalles',[DiaRutinaController::class,'obtenerDetalles']);
Route::get('/diarutina/obtenerCabecera',[DiaRutinaController::class,'obtenerCabecera']);
Route::put('/diarutina/anular',[DiaRutinaController::class,'delete']);
Route::put('/diarutina/modificar',[DiaRutinaController::class,'update']);
Route::get('/diarutina/obtenerDetalles2',[DiaRutinaController::class,'obtenerDetalles2']);
Route::put('/detallerutina/eliminar',[DiaRutinaController::class,'eliminarDetalle']);

//Rutas para Dieta
/*
Route::get('/dieta',[DietaController::class,'index']);
Route::post('/dieta/registrar',[DietaController::class,'store']);
Route::get('/dieta/obtenerDetalles',[DietaController::class,'obtenerDetalles']);
Route::get('/dieta/obtenerCabecera',[DietaController::class,'obtenerCabecera']);
Route::put('/dieta/anular',[DietaController::class,'delete']);
Route::put('/dieta/modificar',[DietaController::class,'update']);
Route::get('/dieta/obtenerDetalles2',[DietaController::class,'obtenerDetalles2']);
Route::put('/detalle/eliminar',[DietaController::class,'eliminarDetalle']);
*/
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

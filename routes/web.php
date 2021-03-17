<?php

use Illuminate\Support\Facades\Route;

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
    return view('contenido/contenido');
});




//tipo telefono
Route::get('/tipotelefono','App\Http\Controllers\TipoTelefonoController@index');
Route::post('/tipotelefono/registrar','App\Http\Controllers\TipoTelefonoController@store');
Route::put('/tipotelefono/actualizar','App\Http\Controllers\TipoTelefonoController@update');
Route::put('/tipotelefono/eliminar','App\Http\Controllers\TipoTelefonoController@eliminar');

//persona
Route::get('/persona','App\Http\Controllers\PersonaController@index');
Route::post('/persona/registrar','App\Http\Controllers\PersonaController@store');
Route::put('/persona/actualizar','App\Http\Controllers\PersonaController@update');
Route::put('/persona/eliminar','App\Http\Controllers\PersonaController@eliminar');

//Route::resource('persona','App\Http\Controllers\PersonaController');

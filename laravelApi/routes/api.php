<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
   
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::get('users', 'UserController@index');
    
    // Rutas para la entidad Alumno
    Route::get('alumnos', 'AlumnoController@index');
    Route::get('alumnos/{id}', 'AlumnoController@show');
    Route::post('alumnos', 'AlumnoController@store');
    Route::put('alumnos/{id}', 'AlumnoController@update');
    Route::delete('alumnos/{id}', 'AlumnoController@destroy');
    
    // Rutas para la entidad Materia
    Route::get('materias', 'MateriaController@index');
    Route::get('materias/{id}', 'MateriaController@show');
    Route::post('materias', 'MateriaController@store');
    Route::put('materias/{id}', 'MateriaController@update');
    Route::delete('materias/{id}', 'MateriaController@destroy');

    // Rutas para la entidad Clase
    Route::get('clases', 'ClaseController@index');
    Route::get('clases/{id}', 'ClaseController@show');
    Route::post('clases', 'ClaseController@store');
    Route::put('clases/{id}', 'ClaseController@update');
    Route::delete('clases/{id}', 'ClaseController@destroy');

    // Rutas para la entidad Inscripciones
    Route::get('inscripciones', 'InscripcionController@index');
    Route::get('inscripciones/{id}', 'InscripcionController@show');
    Route::post('inscripciones', 'InscripcionController@store');
    Route::put('inscripciones/{id}', 'InscripcionController@update');
    Route::delete('inscripciones/{id}', 'InscripcionController@destroy');
    
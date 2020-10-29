<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('Relacion','ProductosController@Relacion');
Route::get('Productos','ProductosController@getProductos');
Route::get('NewProduct','ProductosController@createProductos');
Route::get('Comentarioss','ComentariossController@getComentario');
Route::get('ComentarioNuevo','ComentariossController@nuevoComentario');
Route::get('ProductoComentario','ComentariossController@comentarioProducto');
Route::get('Eliminar','ComentariossController@delete');
Route::get('EliminarProductos','ComentariossController@Delete');
Route::put('actualizarProducto/{id}','ProductosController@actualizar');
Route::put('actualizarComentario/{id}','ComentariossController@actualizar');
Route::get('Personas','PersonasController@getPersonas');
Route::get('NewPersona','PersonasController@createPersona');
Route::get('Relacion','PersonasController@Relacion');
Route::get('Eliminar','PersonasController@Delete');
Route::put('actualizarPersona/{id}','PersonasController@UpdatePersona');
Route::get('RelacionTodo','PersonasController@RelacionTotal');
Route::post("Productos2",'ProductosController@ejemplo')->middleware('validar');
//});

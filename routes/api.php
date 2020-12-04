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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



                                // directorio de las rutas "productos"
//ver productos
Route::get('/productos/{id?}','API\ProductoController@showProductos')->where("id","[0-9]+");
//guardar productos
Route::middleware('auth:sanctum')->post("/productos",'API\ProductoController@saveProductos');
//buscar productos
Route::middleware('auth:sanctum')->put('/productos/{id?}','API\ProductoController@editProductos')->where("id","[0-9]+");
//eliminar productos
Route::middleware('auth:sanctum')->delete('/productos/{id?}','API\ProductoController@deleteProductos')->where("id","[0-9]+");


//ruta para crear el perfil
Route::post('saveProfile','API\ProfileController@saveProfile');
//ruta para crear el usuario
Route::post('saveUsuario/{numPer?}/NuevoUsuario','API\UserController@saveUsuario')->where("numPer","[0-9]+");

//cosas de android
Route::post('/newUserVic','API\UserController@agregarusuaroVistor');
Route::post('/login','API\UserController@login');





//ruta para iniciar secion como usuario
Route::post('/LogIn/User','AUTH\authTokenController@logIn');
//ruta para iniciar secion como administrador
Route::post('/LogIn/Admon','AUTH\authTokenController@logInAdmon');


//ruta para ver informacion de mi Usuario
Route::middleware('auth:sanctum')->get('/verPerfilUsuarioInfo','API\UserController@verPerfilUsuarioInfo');
//ver la imagen de usuario
Route::middleware('auth:sanctum')->get('/verPerfilUsuarioImg','API\UserController@verPerfilUsuarioImg');
//ruta para actualizar usuario
Route::middleware('auth:sanctum')->post('/actualizarUsuario','API\UserController@actualizarUsuario');

//ruta para cerrar sesión
Route::middleware('auth:sanctum')->get('LogOut','AUTH\authTokenController@LogOut');



//directorio de rutas de la tabla "comentarios"
//ver comentarios
Route::middleware('auth:sanctum')->get('/comentarios/{id?}','API\ComentarioController@ShowComentarios')->where("id","[0-9]+");
//agregar comentarios
Route::middleware('auth:sanctum')->post('/comentarios','API\ComentarioController@saveComentarios');
//buscar comentarios
Route::middleware('auth:sanctum')->put('/comentarios/{id?}','API\ComentarioController@editComentarios')->where("id","[0-9]+");
//eliminar comentarios
Route::middleware('auth:sanctum')->delete('/comentarios/{id?}','API\ComentarioController@deleteComentarios')->where("id","[0-9]+");











//ruta temporal/prueba
Route::post('pruebaTemporal','API\UserController@pruebaTemporal');

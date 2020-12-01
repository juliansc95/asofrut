<?php

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

Route::get('/categoria','CategoriaController@index');
Route::post('/categoria/registrar','CategoriaController@store');
Route::put('/categoria/actualizar','CategoriaController@update');
Route::put('/categoria/desactivar','CategoriaController@desactivar');
Route::put('/categoria/activar','CategoriaController@activar');
Route::get('/categoria/selectCategoria','CategoriaController@selectCategoria');

Route::get('/articulo','ArticuloController@index');
Route::post('/articulo/registrar','ArticuloController@store');
Route::put('/articulo/actualizar','ArticuloController@update');
Route::put('/articulo/desactivar','ArticuloController@desactivar');
Route::put('/articulo/activar','ArticuloController@activar');

Route::get('/cliente','ClienteController@index');
Route::post('/cliente/registrar','ClienteController@store');
Route::put('/cliente/actualizar','ClienteController@update');

Route::get('/proveedor','ProveedorController@index');
Route::post('/proveedor/registrar','ProveedorController@store');
Route::put('/proveedor/actualizar','ProveedorController@update');

//Rutas de los select
Route::get('/tipoId/selectTipoId','TipoIdController@selectTipoId');
Route::get('/sexo/selectSexo','SexoController@selectSexo');
Route::get('/escolaridad/selectEscolaridad','GradoEscolaridadController@selectGradoEscolaridad');
Route::get('/etnia/selectEtnia','EtniaController@selectEtnia');
Route::get('/departamento/selectDepartamento','DepartamentoController@selectDepartamento');
Route::get('/municipio/selectMunicipio','MunicipioController@selectMunicipio');

//Rutas productores
Route::get('/productor','ProductorController@index');
Route::post('/productor/registrar','ProductorController@store');
Route::put('/productor/actualizar','ProductorController@update');
Route::put('/productor/desactivar','ProductorController@desactivar');
Route::put('/productor/activar','ProductorController@activar');
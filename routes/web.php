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

Route::group(['middleware'=>['guest']],function(){
    //Rutas Login
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login','Auth\LoginController@login')->name('login');
});

Route::group(['middleware'=>['auth']],function(){

    Route::post('/logout','Auth\LoginController@logout')->name('logout');

    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');
    
     //Rutas de los select
     Route::get('/tipoId/selectTipoId','TipoIdController@selectTipoId');
     Route::get('/sexo/selectSexo','SexoController@selectSexo');
     Route::get('/escolaridad/selectEscolaridad','GradoEscolaridadController@selectGradoEscolaridad');
     Route::get('/etnia/selectEtnia','EtniaController@selectEtnia');
     Route::get('/departamento/selectDepartamento','DepartamentoController@selectDepartamento');
     Route::get('/municipio/selectMunicipio','MunicipioController@selectMunicipio');
     Route::get('/vereda/selectVereda','VeredaController@selectVereda');
     Route::get('/resguardo/selectResguardo','ResguardoController@selectResguardo');
     Route::get('/productor/selectProductor','ProductorController@selectProductor');
     Route::get('/posesion/selectPosesion','PosesionController@selectPosesion');
     Route::get('/linea/selectLinea','LineaController@selectLinea');
     Route::get('/finca/selectFinca/{id}','FincaController@selectFinca');
     Route::get('/cadena/selectCadena','CadenaController@selectCadena');
     Route::get('/lugarVenta/selectLugarVenta','LugarVentaController@selectLugarVenta');
    

    Route::group(['middleware'=>['Administrador']],function(){
    
    //Rutas Categoria Moras
    Route::get('/categoriaMora','CategoriaMoraController@index');
    Route::post('/categoriaMora/registrar','CategoriaMoraController@store');
    Route::put('/categoriaMora/actualizar','CategoriaMoraController@update');    

    //Rutas Cultivos
    Route::get('/cultivo','CultivoController@index');
    Route::post('/cultivo/registrar','CultivoController@store');
    Route::put('/cultivo/actualizar','CultivoController@update');    

     //Rutas Fincas
    Route::get('/finca','FincaController@index');
    Route::post('/finca/registrar','FincaController@store');
    Route::put('/finca/actualizar','FincaController@update');

     //Rutas productores
     Route::get('/productor','ProductorController@index');
     Route::post('/productor/registrar','ProductorController@store');
     Route::put('/productor/actualizar','ProductorController@update');
     
     
     //Rutas roles
     Route::get('/rol','RolController@index');
     Route::get('/rol/selectRol','RolController@selectRol');
     
     //Rutas usuarios
     Route::get('/user','UserController@index');
     Route::post('/user/registrar','UserController@store');
     Route::put('/user/actualizar','UserController@update');
     Route::put('/user/desactivar','UserController@desactivar');
     Route::put('/user/activar','UserController@activar');

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
    });


    Route::group(['middleware'=>['TecnicoComercial']],function(){

    });

    Route::group(['middleware'=>['TecnicoExtensionista']],function(){
        //Rutas Fincas
        Route::get('/finca','FincaController@index');
        Route::post('/finca/registrar','FincaController@store');
        Route::put('/finca/actualizar','FincaController@update');
        
        //Rutas Cultivos
        Route::get('/cultivo','CultivoController@index');
        Route::post('/cultivo/registrar','CultivoController@store');
        Route::put('/cultivo/actualizar','CultivoController@update'); 

          //Rutas productores
        Route::get('/productor','ProductorController@index');
        Route::post('/productor/registrar','ProductorController@store');
        Route::put('/productor/actualizar','ProductorController@update');
    });

    Route::group(['middleware'=>['Productor']],function(){
     Route::get('/cultivo','CultivoController@index');   
     Route::get('/productor','ProductorController@index');
     Route::get('/finca','FincaController@index');
     
    });

    
    
    
    
   
});    

//Route::get('/home', 'HomeController@index')->name('home');

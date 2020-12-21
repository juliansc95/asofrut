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
     Route::get('/finca/selectFincaEncuesta','FincaController@selectFincaEncuesta');
     Route::get('/cadena/selectCadena','CadenaController@selectCadena');
     Route::get('/lugarVenta/selectLugarVenta','LugarVentaController@selectLugarVenta');
     Route::get('/productor/selectProductor2','ProductorController@selectProductor2');
     Route::get('/linea/selectLinea2','LineaController@selectLinea2');
     Route::get('/lugarVenta/selectLugarVenta2','LugarVentaController@selectLugarVenta2');
     Route::get('/equipoAplicacion/selectEquipo','EquipoAplicacionController@selectEquipo');
     Route::get('/metodoAplicacion/selectMetodo','EquipoAplicacionController@selectMetodo');
     Route::get('/unidadAplicacion/selectUnidad','EquipoAplicacionController@selectUnidad');
     Route::get('/unidadDosis/selectDosis','EquipoAplicacionController@selectDosis');
     Route::get('/producto/selectProducto2','EquipoAplicacionController@selectProducto2');

     //Rutas Encuesta fitosanitaria
     Route::get('/fitosanitaria', 'EncuestaFitosanitariaController@index');
     Route::post('/fitosanitaria/registrar', 'EncuestaFitosanitariaController@store');
     Route::get('/fitosanitaria/id', 'EncuestaFitosanitariaController@MostrarId');

     //Rutas Encuesta asofrut
     Route::get('/visita', 'EncuestaAsofrutController@index');
     Route::post('/visita/registrar', 'EncuestaAsofrutController@store');

     Route::group(['middleware'=>['Productor']],function(){
        Route::get('/cultivo','CultivoController@index');   
        Route::get('/productor','ProductorController@index');
        Route::get('/finca','FincaController@index');
       });

    Route::group(['middleware'=>['Administrador']],function(){
    
   
     //Rutas Ventas
     Route::get('/venta', 'VentaController@index');
     Route::post('/venta/registrar', 'VentaController@store');
     Route::put('/venta/desactivar', 'VentaController@desactivar');
     Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
     Route::get('/venta/obtenerDetalles', 'VentaController@obtenerVentaCategoria');
     Route::put('/venta/pasarFacturacion', 'VentaController@pasarFacturacion');    
     Route::put('/venta/pasarDisponiblePago', 'VentaController@pasarDisponiblePago');    
     Route::put('/venta/pasarPagado', 'VentaController@pasarPagado');    
     Route::get('/venta/pdf/{id}','VentaController@pdf')->name('venta_pdf');
     Route::get('/venta/listarPdf','VentaController@listarPdf')->name('ventas_pdf');
     Route::get('/venta/listarDiario','VentaController@listarPdfDiario')->name('ventas_dia_pdf');
    

     //Rutas Lugares de Venta
     Route::get('/lugarVenta','LugarVentaController@index');
     Route::post('/lugarVenta/registrar','LugarVentaController@store');
     Route::put('/lugarVenta/actualizar','LugarVentaController@update');

    //Rutas Categoria Moras
    Route::get('/categoriaMora','CategoriaMoraController@index');
    Route::post('/categoriaMora/registrar','CategoriaMoraController@store');
    Route::put('/categoriaMora/actualizar','CategoriaMoraController@update');    
    Route::get('/categoriaMora/buscarCategoria','CategoriaMoraController@buscarCategoria');
    Route::get('/categoriaMora/listarCategoria','CategoriaMoraController@listarCategoria');  

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
    //Rutas Ventas
    Route::get('/venta', 'VentaController@index');
    Route::post('/venta/registrar', 'VentaController@store');
    Route::put('/venta/desactivar', 'VentaController@desactivar');
    Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
    Route::get('/venta/obtenerDetalles', 'VentaController@obtenerVentaCategoria');
    Route::put('/venta/pasarFacturacion', 'VentaController@pasarFacturacion');    
    Route::put('/venta/pasarDisponiblePago', 'VentaController@pasarDisponiblePago');    
    Route::put('/venta/pasarPagado', 'VentaController@pasarPagado'); 
    
     //Rutas Categoria Moras
    Route::get('/categoriaMora','CategoriaMoraController@index');
    Route::get('/categoriaMora/buscarCategoria','CategoriaMoraController@buscarCategoria');
    Route::get('/categoriaMora/listarCategoria','CategoriaMoraController@listarCategoria');      
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

    

    
    
    
    
   
});    

//Route::get('/home', 'HomeController@index')->name('home');

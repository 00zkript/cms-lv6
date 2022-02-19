<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


// Route::get('/test', function(\Illuminate\Http\Request $request){
//     if (!$request->ajax()){
//         return back();
//     }
//     dd(session()->all());
//
//
// });



Route::get('/', 'Web\HomeController@index')->name('web.home');


Route::get('/contactar','Web\ContactoController@index')->name('web.contacto');
Route::post('/contacto/enviar','Web\ContactoController@enviar')->name('web.contacto.enviar');

Route::post('/suscripcion/enviar','Web\SuscripcionController@enviar')->name('web.suscripcion.enviar');

Route::get('/pagina','Web\PaginaController@index')->name('web.pagina');
Route::get('/pagina/{slug}','Web\PaginaController@detalle')->name('web.pagina.detalle');








Route::get('login-panel', 'Panel\LoginController@index')->name('login-panel');
Route::post('login-panel/verificar', 'Panel\LoginController@verificar')->name('login-panel.verificar');
Route::get('login-panel/salir', 'Panel\LoginController@salir')->name('login-panel.salir');



Route::middleware(['admin'])->prefix('panel')->group(function (){

    Route::resource('/home','Panel\HomeController')->only(['index']);

    Route::get('/configuracion','Panel\ConfiguracionController@edit')->name('configuracion.edit');
    Route::put('/configuracion/update','Panel\ConfiguracionController@update')->name('configuracion.update');


    Route::resource('empresa','Panel\EmpresaController');
    Route::resource('contacto','Panel\ContactoController')->only(['index','update']);
    Route::resource('nosotros', 'Panel\NosotrosController')->only(['index','update']);



    Route::get('menu/getPosicion','Panel\MenuController@getPosicion')->name('menu.getPosicion');
    Route::get('menu/getParientes','Panel\MenuController@getParientes')->name('menu.getParientes');
    Route::post('menu/habilitar','Panel\MenuController@habilitar')->name('menu.habilitar');
    Route::post('menu/inhabilitar','Panel\MenuController@inhabilitar')->name('menu.inhabilitar');
    Route::post('menu/listar','Panel\MenuController@listar')->name('menu.listar');
    Route::resource('menu','Panel\MenuController');



    Route::post('pagina/inhabilitar','Panel\PaginaController@inhabilitar')->name('pagina.inhabilitar');
    Route::post('pagina/habilitar','Panel\PaginaController@habilitar')->name('pagina.habilitar');
    Route::post('pagina/listar','Panel\PaginaController@listar')->name('pagina.listar');
    Route::resource('pagina','Panel\PaginaController');

    Route::post('servicio/inhabilitar','Panel\ServicioController@inhabilitar')->name('servicio.inhabilitar');
    Route::post('servicio/habilitar','Panel\ServicioController@habilitar')->name('servicio.habilitar');
    Route::post('servicio/listar','Panel\ServicioController@listar')->name('servicio.listar');
    Route::resource('servicio', 'Panel\ServicioController');


    Route::post('proyecto/sortFiles','Panel\ProyectoController@sortFiles')->name('proyecto.sortFiles');
    Route::post('proyecto/removeFile','Panel\ProyectoController@removeFile')->name('proyecto.removeFile');
    Route::post('proyecto/habilitar','Panel\ProyectoController@habilitar')->name('proyecto.habilitar');
    Route::post('proyecto/listar','Panel\ProyectoController@listar')->name('proyecto.listar');
    Route::resource('proyecto', 'Panel\ProyectoController');



    Route::post('categoria-producto/habilitar','Panel\CategoriaProductoController@habilitar')->name('categoria-producto.habilitar');
    Route::post('categoria-producto/listar','Panel\CategoriaProductoController@listar')->name('categoria-producto.listar');
    Route::resource('categoria-producto', 'Panel\CategoriaProductoController');


    Route::post('producto/eliminar-pdf','Panel\ProductoController@eliminarPdf')->name('producto.eliminarPdf');
    Route::post('producto/habilitar','Panel\ProductoController@habilitar')->name('producto.habilitar');
    Route::post('producto/listar','Panel\ProductoController@listar')->name('producto.listar');
    Route::resource('producto', 'Panel\ProductoController');













});



//rutas para limpiar cache
//Clear Cache facade value:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

//Clear Config cache:
Route::get('/config-clear', function () {
    $exitCode = Artisan::call('config:clear');
    return '<h1>Clear Config cleared</h1>';
});

//fin

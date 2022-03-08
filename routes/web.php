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



Route::get('/', [App\Http\Controllers\Web\HomeController::class,'index'])->name('web.home');


Route::get('/contactar',[App\Http\Controllers\Web\ContactoController::class,'index'])->name('web.contacto');
Route::post('/contacto/enviar',[App\Http\Controllers\Web\ContactoController::class,'enviar'])->name('web.contacto.enviar');

Route::post('/suscripcion/enviar',[App\Http\Controllers\Web\SuscripcionController::class,'enviar'])->name('web.suscripcion.enviar');

Route::get('/pagina',[App\Http\Controllers\Web\PaginaController::class,'index'])->name('web.pagina');
Route::get('/pagina/{slug}',[App\Http\Controllers\Web\PaginaController::class,'detalle'])->name('web.pagina.detalle');








Route::get('login-panel', [App\Http\Controllers\Panel\LoginController::class,'index'])->name('login-panel');
Route::post('login-panel/verificar', [App\Http\Controllers\Panel\LoginController::class,'verificar'])->name('login-panel.verificar');
Route::get('login-panel/salir', [App\Http\Controllers\Panel\LoginController::class,'salir'])->name('login-panel.salir');



Route::middleware(['admin'])->prefix('panel')->group(function (){

    Route::resource('/home',App\Http\Controllers\Panel\HomeController::class)->only(['index']);

    Route::get('/configuracion',[App\Http\Controllers\Panel\ConfiguracionController::class,'edit'])->name('configuracion.edit');
    Route::put('/configuracion/update',[App\Http\Controllers\Panel\ConfiguracionController::class,'update'])->name('configuracion.update');


    Route::resource('empresa',App\Http\Controllers\Panel\EmpresaController::class);
    Route::resource('contacto',App\Http\Controllers\Panel\ContactoController::class)->only(['index','update']);
    Route::resource('nosotros', App\Http\Controllers\Panel\NosotrosController::class)->only(['index','update']);



    Route::get('menu/getPosicion',[App\Http\Controllers\Panel\MenuController::class,'getPosicion'])->name('menu.getPosicion');
    Route::get('menu/getParientes',[App\Http\Controllers\Panel\MenuController::class,'getParientes'])->name('menu.getParientes');
    Route::post('menu/habilitar',[App\Http\Controllers\Panel\MenuController::class,'habilitar'])->name('menu.habilitar');
    Route::post('menu/inhabilitar',[App\Http\Controllers\Panel\MenuController::class,'inhabilitar'])->name('menu.inhabilitar');
    Route::post('menu/listar',[App\Http\Controllers\Panel\MenuController::class,'listar'])->name('menu.listar');
    Route::resource('menu',App\Http\Controllers\Panel\MenuController::class);



    Route::post('pagina/inhabilitar',[App\Http\Controllers\Panel\PaginaController::class,'inhabilitar'])->name('pagina.inhabilitar');
    Route::post('pagina/habilitar',[App\Http\Controllers\Panel\PaginaController::class,'habilitar'])->name('pagina.habilitar');
    Route::post('pagina/listar',[App\Http\Controllers\Panel\PaginaController::class,'listar'])->name('pagina.listar');
    Route::resource('pagina',App\Http\Controllers\Panel\PaginaController::class);

    Route::post('servicio/inhabilitar',[App\Http\Controllers\Panel\ServicioController::class,'inhabilitar'])->name('servicio.inhabilitar');
    Route::post('servicio/habilitar',[App\Http\Controllers\Panel\ServicioController::class,'habilitar'])->name('servicio.habilitar');
    Route::post('servicio/listar',[App\Http\Controllers\Panel\ServicioController::class,'listar'])->name('servicio.listar');
    Route::resource('servicio', App\Http\Controllers\Panel\ServicioController::class);


    Route::post('proyecto/sortFiles',[App\Http\Controllers\Panel\ProyectoController::class,'sortFiles'])->name('proyecto.sortFiles');
    Route::post('proyecto/removeFile',[App\Http\Controllers\Panel\ProyectoController::class,'removeFile'])->name('proyecto.removeFile');
    Route::post('proyecto/habilitar',[App\Http\Controllers\Panel\ProyectoController::class,'habilitar'])->name('proyecto.habilitar');
    Route::post('proyecto/listar',[App\Http\Controllers\Panel\ProyectoController::class,'listar'])->name('proyecto.listar');
    Route::resource('proyecto', App\Http\Controllers\Panel\ProyectoController::class);



    Route::post('categoria-producto/habilitar',[App\Http\Controllers\Panel\CategoriaProductoController::class,'habilitar'])->name('categoria-producto.habilitar');
    Route::post('categoria-producto/listar',[App\Http\Controllers\Panel\CategoriaProductoController::class,'listar'])->name('categoria-producto.listar');
    Route::resource('categoria-producto', App\Http\Controllers\Panel\CategoriaProductoController::class);


    Route::post('banner/cantidadBanners',[\App\Http\Controllers\Panel\BannerController::class,'cantidadBanners'])->name("banner.cantidadBanners");
    Route::post('banner/removerImagen',[\App\Http\Controllers\Panel\BannerController::class,'removerImagen'])->name("banner.removerImagen");
    Route::post('banner/habilitar',[\App\Http\Controllers\Panel\BannerController::class,'habilitar'])->name("banner.habilitar");
    Route::post('banner/inhabilitar',[\App\Http\Controllers\Panel\BannerController::class,'inhabilitar'])->name("banner.inhabilitar");
    Route::post('banner/listar',[\App\Http\Controllers\Panel\BannerController::class,'listar'])->name("banner.listar");
    Route::resource('banner',\App\Http\Controllers\Panel\BannerController::class);









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

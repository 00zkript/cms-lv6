<?php

namespace App\Http\Controllers\Panel;

use App\Models\TipoRuta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class MenuController extends Controller
{

    public function index(Request $request)
    {

        $rutaInterna = Menu::getRoutesInternal();


        $tipo_ruta = TipoRuta::query()->where('estado',1)->get();


        $menu = Menu::query()
            ->with(['padre'])
            ->orderBy('idmenu','DESC')
            ->paginate(10,['*'],'pagina',1);


        return view('panel.menu.index')->with(compact('menu','rutaInterna','tipo_ruta'));
    }

    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $menu = Menu::query()
            ->with(['padre'])
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idmenu','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.menu.listado')->with(compact('menu'))->render());

    }

    public function store(Request $request)
    {

        if (!$request->ajax()){
            return abort(403);
        }

        try{
            $ruta  = NULL;

            if($request->input('tipoRuta') == 2){
                $ruta  = $request->input('rutaInterna');
            }

            if($request->input('tipoRuta')  == 3){
                $ruta   = $request->input('rutaExterna') ?: 'javscript:void(0);';
            }


            $menu              = new Menu;
            $menu->pariente    = $request->input('pariente') ?: 0;
            $menu->nombre      = $request->input('nombre');
            $menu->slug        = Str::slug($request->input('nombre'));
            $menu->idtipo_ruta = $request->input('tipoRuta');
            $menu->ruta        = $ruta;
            $menu->posicion    = $request->input('posicion');
            $menu->estado      = $request->input('estado');
            $menu->save();

            return response()->json([
                'mensaje'=> "Registro creado exitosamente.",
            ]);

        }catch (\Throwable $th){

            return response()->json([
                'mensaje'=> "No se pudo crear el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);

        }

    }

    public function show(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        $menu = DB::table('menu AS m')
            ->leftJoin('menu AS me','m.idmenu','=','me.pariente')
            ->selectRaw('m.*,me.nombre AS nombrePariente')
            ->where('m.idmenu',$request->input('idmenu'))
            ->first();

        if (!$menu){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }

        return response()->json($menu);

    }

    public function edit(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        $menu = DB::table('menu')
            ->where('idmenu',$request->input('idmenu'))
            ->first();

        if (!$menu){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }

        return response()->json($menu);


    }

    public function update(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        try{
            $ruta = NULL;

            if($request->input('tipoRutaEditar') == 2){
                $ruta =  $request->input('rutaInternaEditar');
            }

            if($request->input('tipoRutaEditar') == 3){
                $ruta =  $request->input('rutaExternaEditar') ?: 'javscript:void(0);';
            }


            $menu               = Menu::query()->findOrFail($request->input('idmenu'));
            $menu->pariente     = $request->input('parienteEditar') ?: 0;
            $menu->nombre       = $request->input('nombreEditar');
            $menu->slug         = Str::slug($request->input('nombreEditar'));
            $menu->idtipo_ruta  = $request->input('tipoRutaEditar');
            $menu->ruta         = $ruta;
            $menu->posicion     = $request->input('posicionEditar');
            $menu->estado       = $request->input('estadoEditar');
            $menu->update();

            return response()->json([
                'mensaje'=> "Registro actualizado exitosamente.",
            ]);

        }catch (\Throwable $th){


            return response()->json([
                'mensaje'=> "No se pudo actualizar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }

    }

    public function habilitar(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        try {

            $menu = Menu::query()->findOrFail($request->input('idmenu'));
            $menu->estado = 1;
            $menu->update();



            return response()->json([
                'mensaje'=> "Registro habilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo habilitar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }

    }

    public function inhabilitar(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        try{

            $menu = Menu::query()->findOrFail($request->input('idmenu'));
            $menu->estado = 0;
            $menu->update();

            return response()->json([
                'mensaje'=> "Registro inhabilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo inhabilitar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }

    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        try{

            $menu = Menu::query()->findOrFail($request->input('idmenu'));
            $menu->delete();

            return response()->json([
                'mensaje'=> "Registro eliminado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo eliminar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }

    }

    public function getPosicion(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        $pariente = $request->input('pariente');
        $menu = DB::table('menu')
            ->where('pariente',$pariente)
            ->count();


        return response()->json(["posicion_maxima" => $menu + 1]);

    }

    public function getParientes(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        $pagina = DB::table('menu')
            ->orderBy('pariente','asc')
            ->orderBy('idmenu','asc')
            ->get();

        return response()->json($pagina);
    }


}

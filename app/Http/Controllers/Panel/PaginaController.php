<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Pagina;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaginaController extends Controller
{



    public function index()
    {

        $paginas = Pagina::query()
            ->orderBy('idpagina','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.pagina.index')->with(compact('paginas'));


    }


    public function listar(Request $request)
    {

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $paginas = Pagina::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('titulo','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idpagina','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.pagina.listado')->with(compact('paginas'))->render());

    }

    public function store(Request $request)
    {

        try {
            $pagina = new Pagina();
            $pagina->titulo    = $request->input('titulo');
            $pagina->slug    =  Str::slug($request->input('titulo'));
            $pagina->contenido = $request->input('contenido');
            $pagina->estado    = $request->input('estado');

            $pagina->save();

            return response()->json([
                "mensaje"=> "Registro creado exitosamente.",
            ]);


        } catch (\Throwable $th) {

            return response()->json([
                "mensaje"=> "No se pudo crear el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);

        }



    }

    public function show(Request $request)
    {

        $registro = Pagina::query()->find($request->input('idpagina'));

        if(!$registro){
            return response()->json( ["mensaje" => "Registro no encontrado"],400);
        }

        return response()->json($registro);

    }

    public function edit(Request $request)
    {

        $registro = Pagina::query()->find($request->input('idpagina'));

        if(!$registro){
            return response()->json( ["mensaje" => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request)
    {
        try {
            $pagina = Pagina::query()->findOrFail($request->input('idpagina'));

            $pagina->titulo    = $request->input('tituloEditar');
            $pagina->slug    =  Str::slug($request->input('tituloEditar'));
            $pagina->contenido = $request->input('contenidoEditar');
            $pagina->estado    = $request->input('estadoEditar');

            $pagina->update();

            return response()->json([
                "mensaje"=> "Registro actualizado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                "mensaje"=> "No se pudo actualizar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }



    }


    public function habilitar(Request $request)
    {
        try {
            $pagina = Pagina::query()->findOrFail($request->input('idpagina'));
            $pagina->estado    = 1;
            $pagina->update();

            return response()->json([
                "mensaje"=> "Registro habilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                "mensaje"=> "No se pudo habilitado el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $pagina = Pagina::query()->findOrFail($request->input('idpagina'));
            $pagina->estado    = 0;

            $pagina->update();

            return response()->json([
                "mensaje"=> "Registro inhabilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                "mensaje"=> "No se pudo inhabilitado el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }
    }



}

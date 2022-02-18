<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\CategoriaProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriaProductoController extends Controller
{


    public function index()
    {

        $categoriaProducto = CategoriaProducto::query()
            ->orderBy('idcategoria_producto','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.categoriaProducto.index')->with(compact('categoriaProducto'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $categoriaProducto = CategoriaProducto::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idcategoria_producto','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.categoriaProducto.listado')->with(compact('categoriaProducto'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        try {
            $pagina = new CategoriaProducto();
            $pagina->nombre    = $request->input('nombre');
            $pagina->slug      = Str::slug($request->input('nombre'));
            $pagina->estado    = $request->input('estado');

            $pagina->save();

            return response()->json([
                'mensaje'=> "Registro creado exitosamente.",
            ]);


        } catch (\Throwable $th) {

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

        $registro = CategoriaProducto::query()->find($request->input('idcategoria_producto'));

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }

        return response()->json($registro);

    }

    public function edit(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        $registro = CategoriaProducto::query()->find($request->input('idcategoria_producto'));

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        try {
            $pagina = CategoriaProducto::query()->findOrFail($request->input('idcategoria_producto'));
            $pagina->nombre    = $request->input('nombreEditar');
            $pagina->slug      = Str::slug($request->input('nombreEditar'));
            $pagina->estado    = $request->input('estadoEditar');

            $pagina->update();

            return response()->json([
                'mensaje'=> "Registro actualizado exitosamente.",
            ]);

        } catch (\Throwable $th) {

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
            $pagina = CategoriaProducto::query()->findOrFail($request->input('idcategoria_producto'));
            $pagina->estado    = 1;
            $pagina->update();

            return response()->json([
                'mensaje'=> "Registro habilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo habilitado el registro.",
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

        try {
            $pagina = CategoriaProducto::query()->findOrFail($request->input('idcategoria_producto'));
            $pagina->estado    = 0;

            $pagina->update();

            return response()->json([
                'mensaje'=> "Registro inhabilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo inhabilitado el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }
    }


}

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
        $categoriaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $categoriaProducto = CategoriaProducto::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idcategoria_producto','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$categoriaActual);



        return response()->json(view('panel.categoriaProducto.listado')->with(compact('categoriaProducto'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        try {
            $categoria = new CategoriaProducto();
            $categoria->nombre    = $request->input('nombre');
            $categoria->slug      = Str::slug($request->input('nombre'));
            $categoria->estado    = $request->input('estado');

            $categoria->save();

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
            $categoria = CategoriaProducto::query()->findOrFail($request->input('idcategoria_producto'));
            $categoria->nombre    = $request->input('nombreEditar');
            $categoria->slug      = Str::slug($request->input('nombreEditar'));
            $categoria->estado    = $request->input('estadoEditar');

            $categoria->update();

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
            $categoria = CategoriaProducto::query()->findOrFail($request->input('idcategoria_producto'));
            $categoria->estado    = 1;
            $categoria->update();

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
            $categoria = CategoriaProducto::query()->findOrFail($request->input('idcategoria_producto'));
            $categoria->estado    = 0;

            $categoria->update();

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

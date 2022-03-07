<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MarcaController extends Controller
{


    public function index()
    {

        $marcas = Marca::query()
            ->orderBy('idmarca','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.marca.index')->with(compact('marcas'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $marcaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $marcas = Marca::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idmarca','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$marcaActual);



        return response()->json(view('panel.marca.listado')->with(compact('marcas'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        try {
            $marca = new Marca();
            $marca->nombre    = $request->input('nombre');
            $marca->slug      = Str::slug($request->input('nombre'));
            $marca->estado    = $request->input('estado');

            if($request->hasFile('imagen')){
                $nombreImagen = Storage::disk('panel')->putFile('marca',$request->file('imagen'));
                $marca->imagen = basename($nombreImagen);
            }

            $marca->save();


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

        $registro = Marca::query()->find($request->input('idmarca'));

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

        $registro = Marca::query()->find($request->input('idmarca'));

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
            $marca = Marca::query()->findOrFail($request->input('idmarca'));
            $marca->nombre    = $request->input('nombreEditar');
            $marca->slug      = Str::slug($request->input('nombreEditar'));
            $marca->estado    = $request->input('estadoEditar');

            if($request->hasFile('imagenEditar')){
                $nombreImagen = Storage::disk('panel')->putFile('marca',$request->file('imagenEditar'));
                $marca->imagen = basename($nombreImagen);
            }

            $marca->update();

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
            $marca = Marca::query()->findOrFail($request->input('idmarca'));
            $marca->estado    = 1;
            $marca->update();

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
            $marca = Marca::query()->findOrFail($request->input('idmarca'));
            $marca->estado    = 0;

            $marca->update();

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

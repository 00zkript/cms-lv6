<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExampleController extends Controller
{

    public function index()
    {

        $registros = Example::query()
            ->orderBy('idregistro','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.example.index')->with(compact('registros'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Example::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idregistro','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.example.listado')->with(compact('registros'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $registro = new Example();
            $registro->nombre    = $request->input('nombre');
            $registro->slug      = Str::slug($request->input('nombre'));
            $registro->contenido = $request->input('contenido');
            // if ($request->hasFile('imagen')){
            //     $nombreImagen = Storage::disk('panel')->putFile('registro',$request->file('imagen'));
            //     $registro->imagen = basename($nombreImagen);
            // }
            $registro->estado    = $request->input('estado');

            $registro->save();

            if (is_array($request->imagen)) {
                foreach ($request->imagen as $key => $img) {
                    if ($request->hasFile('imagen.'.$key)){
                        $nombreImagen = Storage::disk('panel')->putFile('registro',$img);

                        $imagen             = new ExampleImagen();
                        $imagen->idregistro = $registro->idregistro ;
                        $imagen->nombre     = basename($nombreImagen);
                        $imagen->posicion      = $key+1;
                        $imagen->save();
                    }
                }
            }

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
            return abort(404);
        }

        $registro = Example::query()->with(["imagenes"])->find($request->input('idregistro'));

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function edit(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $registro = Example::query()->with(["imagenes"])->find($request->input('idregistro'));

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $registro = Example::query()->findOrFail($request->input('idregistro'));

            $registro->nombre    = $request->input('nombreEditar');
            $registro->slug    =  Str::slug($request->input('nombreEditar'));
            $registro->contenido = $request->input('contenidoEditar');
            $registro->estado    = $request->input('estadoEditar');
            // if ($request->hasFile('imagenEditar')){
            //     $nombreImagen = Storage::disk('panel')->putFile('registro',$request->file('imagenEditar'));
            //     $registro->imagen = basename($nombreImagen);
            // }

            $registro->update();

            if (is_array($request->imagenEditar)) {

                $max = ExampleImagen::query()
                    ->where('idregistro',$registro->idregistro)
                    ->orderBy('posicion','desc')
                    ->first();

                $maximaPosicion = $max ? $max->posicion : 0;


                foreach ($request->imagenEditar as $key => $img) {
                    if ($request->hasFile('imagenEditar.'.$key)){

                        $nombreImagen = Storage::disk('panel')->putFile('registro',$img);

                        $imagen             = new ExampleImagen();
                        $imagen->idregistro = $registro->idregistro ;
                        $imagen->nombre     = basename($nombreImagen);
                        $imagen->posicion   = $maximaPosicion + $key + 1;;
                        $imagen->save();
                    }
                }
            }


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
            return abort(404);
        }

        try {
            $registro = Example::query()->findOrFail($request->input('idregistro'));
            $registro->estado    = 1;
            $registro->update();

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
            return abort(404);
        }

        try {
            $registro = Example::query()->findOrFail($request->input('idregistro'));
            $registro->estado    = 0;

            $registro->update();

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
            return abort(404);
        }

        try {
            $registro = Example::query()->findOrFail($request->input('idregistro'));
            $registro->delete();

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


    public function removeFile(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {

            $imagen = ExampleImagen::query()->findOrFail($request->input('key'));
            $imagen->delete();

            return response()->json([
                'mensaje'=> "Archivo eliminado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo eliminar el archivo.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }

    }



    public function sortFiles(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {

            foreach (json_decode($request->stack) as $key => $item) {
                $imagen = ExampleImagen::query()->find($item->key);
                $imagen->posicion = $key+1;
                $imagen->update();
            }

            return response()->json([
                'mensaje'=> "Orden modificado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo modificar el orden.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }



}

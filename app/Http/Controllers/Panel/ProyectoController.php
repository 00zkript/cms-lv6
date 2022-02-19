<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageHelperTrait;
use App\Models\Proyecto;
use App\Models\ProyectoImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProyectoController extends Controller
{


    public function index()
    {

        $proyectos = Proyecto::query()
            ->orderBy('idproyecto','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.proyecto.index')->with(compact('proyectos'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $proyectoActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $proyectos = Proyecto::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('titulo','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idproyecto','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$proyectoActual);



        return response()->json(view('panel.proyecto.listado')->with(compact('proyectos'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        try {
            $proyecto = new Proyecto();
            $proyecto->titulo    = $request->input('titulo');
            $proyecto->slug      = Str::slug($request->input('titulo'));
            $proyecto->contenido = $request->input('contenido');
            // if ($request->hasFile('imagen')){
            //     $nombreImagen = Storage::disk('panel')->putFile('proyecto',$request->file('imagen'));
            //     $proyecto->imagen = basename($nombreImagen);
            // }
            $proyecto->estado    = $request->input('estado');

            $proyecto->save();

            if (is_array($request->imagen)) {
                foreach ($request->imagen as $key => $img) {
                    if ($request->hasFile('imagen.'.$key)){
                        $nombreImagen = Storage::disk('panel')->putFile('proyecto',$img);

                        $imagen             = new ProyectoImagen();
                        $imagen->idproyecto = $proyecto->idproyecto ;
                        $imagen->nombre     = basename($nombreImagen);
                        $imagen->orden      = $key+1;
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
            return abort(403);
        }

        $registro = Proyecto::query()->find($request->input('idproyecto'));

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }
        $registroImagenes = ProyectoImagen::query()->where('idproyecto',$registro->idproyecto)->get();

        $registro->imagenData = $this->allFilesData('proyecto',$registroImagenes,'idproyecto_imagen');

        return response()->json($registro);

    }

    public function edit(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        $registro = Proyecto::query()->find($request->input('idproyecto'));

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }
        $registroImagenes = ProyectoImagen::query()->where('idproyecto',$registro->idproyecto)->get();

        $registro->imagenData = $this->allFilesData('proyecto',$registroImagenes,'idproyecto_imagen');


        return response()->json($registro);

    }

    public function update(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        try {
            $proyecto = Proyecto::query()->findOrFail($request->input('idproyecto'));

            $proyecto->titulo    = $request->input('tituloEditar');
            $proyecto->slug    =  Str::slug($request->input('tituloEditar'));
            $proyecto->contenido = $request->input('contenidoEditar');
            $proyecto->estado    = $request->input('estadoEditar');
            // if ($request->hasFile('imagenEditar')){
            //     $nombreImagen = Storage::disk('panel')->putFile('proyecto',$request->file('imagenEditar'));
            //     $proyecto->imagen = basename($nombreImagen);
            // }

            $proyecto->update();

            if (is_array($request->imagenEditar)) {
                foreach ($request->imagenEditar as $key => $img) {
                    if ($request->hasFile('imagenEditar.'.$key)){
                        $nombreImagen = Storage::disk('panel')->putFile('proyecto',$img);

                        $max = ProyectoImagen::query()
                            ->where('idproyecto',$proyecto->idproyecto)
                            ->orderBy('orden','desc')
                            ->first();

                        $orden = $max ? ($max->orden + $key + 1) : ($key + 1);

                        $imagen             = new ProyectoImagen();
                        $imagen->idproyecto = $proyecto->idproyecto ;
                        $imagen->nombre     = basename($nombreImagen);
                        $imagen->orden      = $orden;
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
            return abort(403);
        }

        try {
            $proyecto = Proyecto::query()->findOrFail($request->input('idproyecto'));
            $proyecto->estado    = 1;
            $proyecto->update();

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
            $proyecto = Proyecto::query()->findOrFail($request->input('idproyecto'));
            $proyecto->estado    = 0;

            $proyecto->update();

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


    public function removeFile(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        try {

            $imagen = ProyectoImagen::query()->findOrFail($request->input('key'));
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
            return abort(403);
        }

        foreach (json_decode($request->stack) as $key => $item) {
            $imagen = ProyectoImagen::query()->find($item->key);
            $imagen->orden = $key+1;
            $imagen->update();
        }



        return response()->json([
            'mensaje'=> "Orden modificado exitosamente.",
        ]);


    }



}

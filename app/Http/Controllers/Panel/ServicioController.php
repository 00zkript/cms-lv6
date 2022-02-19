<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageHelperTrait;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServicioController extends Controller
{


    public function index()
    {

        $servicios = Servicio::query()
            ->orderBy('idservicio','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.servicio.index')->with(compact('servicios'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $servicioActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $servicios = Servicio::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idservicio','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$servicioActual);



        return response()->json(view('panel.servicio.listado')->with(compact('servicios'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        try {
            $servicio = new Servicio();
            $servicio->nombre    = $request->input('nombre');
            $servicio->slug    =  Str::slug($request->input('nombre'));
            $servicio->contenido = $request->input('contenido');
            $servicio->estado    = $request->input('estado');
            if ($request->hasFile('imagen')){
                $nombreImagen = Storage::disk('panel')->putFile('servicio',$request->file('imagen'));
                $servicio->imagen = basename($nombreImagen);
            }
            $servicio->save();

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

        $registro = Servicio::query()->find($request->input('idservicio'));

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

        $registro = Servicio::query()->find($request->input('idservicio'));

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
            $servicio = Servicio::query()->findOrFail($request->input('idservicio'));

            $servicio->nombre    = $request->input('nombreEditar');
            $servicio->slug    =  Str::slug($request->input('nombreEditar'));
            $servicio->contenido = $request->input('contenidoEditar');
            $servicio->estado    = $request->input('estadoEditar');
            if ($request->hasFile('imagenEditar')){
                $nombreImagen = Storage::disk('panel')->putFile('servicio',$request->file('imagenEditar'));
                $servicio->imagen = basename($nombreImagen);
            }
            $servicio->update();

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
            $servicio = Servicio::query()->findOrFail($request->input('idservicio'));
            $servicio->estado    = 1;
            $servicio->update();

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


    public function inhabilitar(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        try {
            $servicio = Servicio::query()->findOrFail($request->input('idservicio'));
            $servicio->estado    = 0;
            $servicio->update();

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

    public function destroy(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        try {
            $servicio = Servicio::query()->findOrFail($request->input('idservicio'));
            $servicio->delete();

            return response()->json([
                'mensaje'=> "Registro eliminado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo eliminado el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }
    }



}

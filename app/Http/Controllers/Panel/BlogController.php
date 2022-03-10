<?php

namespace App\Http\Controllers\Panel;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public function index()
    {

        $blogs = Blog::query()
            ->orderBy('idblog','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.blog.index')->with(compact('blogs'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $blogs = Blog::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('titulo','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idblog','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.blog.listado')->with(compact('blogs'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $blog = new Blog();
            $blog->titulo    = $request->input('titulo');
            $blog->slug      = Str::slug($request->input('titulo'));
            $blog->contenido = $request->input('contenido');
            $blog->fecha = $request->input('fecha');
            $blog->estado    = $request->input('estado');
            if ($request->hasFile('imagen')){
                $nombreImagen = Storage::disk('panel')->putFile('blog',$request->file('imagen'));
                $blog->imagen = basename($nombreImagen);
            }

            $blog->save();


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

        $blog = Blog::query()->find($request->input('idblog'));

        if(!$blog){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($blog);

    }

    public function edit(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $blog = Blog::query()->find($request->input('idblog'));

        if(!$blog){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($blog);

    }

    public function update(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $blog = Blog::query()->findOrFail($request->input('idblog'));

            $blog->titulo    = $request->input('tituloEditar');
            $blog->slug    =  Str::slug($request->input('tituloEditar'));
            $blog->contenido = $request->input('contenidoEditar');
            $blog->fecha = $request->input('fechaEditar');
            $blog->estado    = $request->input('estadoEditar');
            if ($request->hasFile('imagenEditar')){
                $nombreImagen = Storage::disk('panel')->putFile('blog',$request->file('imagenEditar'));
                $blog->imagen = basename($nombreImagen);
            }

            $blog->update();


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
            $blog = Blog::query()->findOrFail($request->input('idblog'));
            $blog->estado    = 1;
            $blog->update();

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
            $blog = Blog::query()->findOrFail($request->input('idblog'));
            $blog->estado    = 0;
            $blog->update();

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
            $blog = Blog::query()->findOrFail($request->input('idblog'));
            $blog->delete();

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


}

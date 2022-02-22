<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageHelperTrait;
use App\Models\CategoriaProducto;
use App\Models\Producto;
use App\Models\ProductoImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductoController extends Controller
{

    use ImageHelperTrait;

    public function index()
    {


        $productos = Producto::query()
            ->with(['categoria'])
            ->orderBy('idproducto','DESC')
            ->paginate(10,['*'],'pagina',1);


        $categorias = CategoriaProducto::query()->where('estado',1)->get();


        return view('panel.producto.index')->with(compact('productos','categorias'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $productoActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $productos = Producto::query()
            ->with(['categoria'])
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('titulo','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idproducto','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$productoActual);



        return response()->json(view('panel.producto.listado')->with(compact('productos'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        try {
            $producto = new Producto();
            $producto->idcategoria_producto = $request->input('idcategoria_producto');
            $producto->titulo               = $request->input('titulo');
            $producto->subtitulo            = $request->input('subtitulo');
            $producto->slug                 = Str::slug($request->input('titulo'));
            $producto->contenido            = $request->input('contenido');

            if (is_array($request->imagen)) {
                foreach ($request->imagen as $key => $img) {
                    if ($request->hasFile('imagen.'.$key)){
                        $nombreImagen = Storage::disk('panel')->putFile('proyecto',$img);

                        $imagen             = new ProductoImagen();
                        $imagen->idproyecto = $proyecto->idproyecto ;
                        $imagen->nombre     = basename($nombreImagen);
                        $imagen->posicion      = $key+1;
                        $imagen->save();
                    }
                }
            }

            $producto->estado               = $request->input('estado');

            $producto->save();

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

        $registro = Producto::query()->find($request->input('idproducto'));

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

        $registro = Producto::query()->find($request->input('idproducto'));

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
            $producto = Producto::query()->findOrFail($request->input('idproducto'));
            $producto->idcategoria_producto = $request->input('idcategoria_productoEditar');
            $producto->titulo               = $request->input('tituloEditar');
            $producto->subtitulo            = $request->input('subtituloEditar');
            $producto->slug                 = Str::slug($request->input('tituloEditar'));
            $producto->contenido            = $request->input('contenidoEditar');

            if (is_array($request->imagenEditar)) {
                foreach ($request->imagenEditar as $key => $img) {
                    if ($request->hasFile('imagenEditar.'.$key)){
                        $nombreImagen = Storage::disk('panel')->putFile('proyecto',$img);

                        $max = ProductoImagen::query()
                            ->where('idproyecto',$proyecto->idproyecto)
                            ->orderBy('posicion','desc')
                            ->first();

                        $posicion = $max ? ($max->posicion + $key + 1) : ($key + 1);

                        $imagen             = new ProductoImagen();
                        $imagen->idproyecto = $proyecto->idproyecto ;
                        $imagen->nombre     = basename($nombreImagen);
                        $imagen->posicion      = $posicion;
                        $imagen->save();
                    }
                }
            }



            $producto->estado               = $request->input('estadoEditar');

            $producto->update();

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
            $producto = Producto::query()->findOrFail($request->input('idproducto'));
            $producto->estado    = 1;
            $producto->update();

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
            $producto = Producto::query()->findOrFail($request->input('idproducto'));
            $producto->estado    = 0;

            $producto->update();

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


    public function eliminarPdf(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        try {
            $producto = Producto::query()->findOrFail($request->input('idproducto'));
            $producto->pdf    = '';
            $producto->update();

            return response()->json([
                'mensaje'=> "Registro actualizado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo actualizado el registro.",
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

            $imagen = ProductoImagen::query()->findOrFail($request->input('key'));
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
            $imagen = ProductoImagen::query()->find($item->key);
            $imagen->posicion = $key+1;
            $imagen->update();
        }



        return response()->json([
            'mensaje'=> "Orden modificado exitosamente.",
        ]);


    }



}

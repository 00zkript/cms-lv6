<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageHelperTrait;
use App\Models\CategoriaHasProducto;
use App\Models\CategoriaProducto;
use App\Models\Producto;
use App\Models\ProductoImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductoController extends Controller
{


    public function index()
    {


        $productos = Producto::query()
//            ->with(['categoria'])
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
//            ->with(['categoria'])
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
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
            $producto->codigo               = $request->input('codigo');
            $producto->nombre               = $request->input('nombre');
            $producto->slug                 = Str::slug($request->input('nombre'));
            $producto->precio               = $request->input('precio');
            $producto->stock               = $request->input('stock');
            $producto->destacado               = $request->input('destacado',0);
            $producto->descripcion            = $request->input('descripcion');
            $producto->contenido            = $request->input('contenido');
            $producto->estado               = $request->input('estado');
            $producto->save();

            if (is_array($request->imagen)) {
                foreach ($request->imagen as $key => $img) {
                    if ($request->hasFile('imagen.'.$key)){
                        $nombreImagen = Storage::disk('panel')->putFile('producto',$img);

                        $imagen             = new ProductoImagen();
                        $imagen->idproducto = $producto->idproducto ;
                        $imagen->nombre     = basename($nombreImagen);
                        $imagen->posicion      = $key+1;
                        $imagen->save();
                    }
                }
            }

            if (is_array($request->input('idcategoria_producto'))){
                foreach ($request->input('idcategoria_producto') as $item){
                    $categoria = new CategoriaHasProducto();
                    $categoria->idproducto = $producto->idproducto;
                    $categoria->idcategoria = $item;
                    $categoria->save();
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

        $registro = Producto::query()
            ->with(['categoria','imagenes'])
            ->find($request->input('idproducto'));

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

        $registro = Producto::query()
            ->with(['categoria','imagenes'])
            ->find($request->input('idproducto'));

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
            $producto->codigo               = $request->input('codigoEditar');
            $producto->nombre               = $request->input('nombreEditar');
            $producto->slug                 = Str::slug($request->input('nombreEditar'));
            $producto->precio               = $request->input('precioEditar');
            $producto->stock               = $request->input('stockEditar');
            $producto->destacado               = $request->input('destacadoEditar',0);
            $producto->descripcion            = $request->input('descripcionEditar');
            $producto->contenido            = $request->input('contenidoEditar');
            $producto->estado               = $request->input('estadoEditar');
            $producto->update();

            if (is_array($request->imagenEditar)) {
                foreach ($request->imagenEditar as $key => $img) {
                    if ($request->hasFile('imagenEditar.'.$key)){
                        $nombreImagen = Storage::disk('panel')->putFile('producto',$img);

                        $max = ProductoImagen::query()
                            ->where('idproducto',$producto->idproducto)
                            ->orderBy('posicion','desc')
                            ->first();

                        $posicion = $max ? ($max->posicion + $key + 1) : ($key + 1);

                        $imagen             = new ProductoImagen();
                        $imagen->idproducto = $producto->idproducto ;
                        $imagen->nombre     = basename($nombreImagen);
                        $imagen->posicion   = $posicion;
                        $imagen->save();
                    }
                }
            }

            if (is_array($request->input('idcategoria_productoEditar'))){

                CategoriaHasProducto::query()->where('idproducto',$producto->idproducto)->delete();

                foreach ($request->input('idcategoria_productoEditar') as $item){
                    $categoria = new CategoriaHasProducto();
                    $categoria->idproducto = $producto->idproducto;
                    $categoria->idcategoria = $item;
                    $categoria->save();
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

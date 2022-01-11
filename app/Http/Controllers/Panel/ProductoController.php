<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageHelperTrait;
use App\Models\CategoriaProducto;
use App\Models\Producto;
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

        try {
            $producto = new Producto();
            $producto->idcategoria_producto = $request->input('idcategoria_producto');
            $producto->titulo               = $request->input('titulo');
            $producto->subtitulo            = $request->input('subtitulo');
            $producto->slug                 = Str::slug($request->input('titulo'));
            $producto->contenido            = $request->input('contenido');

            if ($request->hasFile('imagen')){
                $nombreImagen = Storage::disk('panel')->putFile('producto',$request->file('imagen'));
                $producto->imagen = basename($nombreImagen);
            }


            $producto->modelo_desde            = $request->input('modelo_desde');
            $producto->modelo_hasta            = $request->input('modelo_hasta');
            $producto->caudal_desde            = $request->input('caudal_desde');
            $producto->caudal_hasta            = $request->input('caudal_hasta');
            $producto->presion_desde            = $request->input('presion_desde');
            $producto->presion_hasta            = $request->input('presion_hasta');

            if ($request->hasFile('pdf')){
                $nombreImagen = Storage::disk('panel')->putFile('producto',$request->file('pdf'));
                $producto->pdf = basename($nombreImagen);
            }

            $producto->estado               = $request->input('estado');

            $producto->save();

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

        $registro = Producto::query()->find($request->input('idproducto'));

        if(!$registro){
            return response()->json( ["mensaje" => "Registro no encontrado"],400);
        }

        $registro->imagenData = $this->oneFileData('producto',$registro->imagen);
        $registro->pdfData = $this->oneFileData('producto',$registro->pdf,'pdf');

        return response()->json($registro);

    }

    public function edit(Request $request)
    {

        $registro = Producto::query()->find($request->input('idproducto'));

        if(!$registro){
            return response()->json( ["mensaje" => "Registro no encontrado"],400);
        }

        $registro->imagenData = $this->oneFileData('producto',$registro->imagen);
        $registro->pdfData = $this->oneFileData('producto',$registro->pdf,'pdf');


        return response()->json($registro);

    }

    public function update(Request $request)
    {
        try {
            $producto = Producto::query()->findOrFail($request->input('idproducto'));
            $producto->idcategoria_producto = $request->input('idcategoria_productoEditar');
            $producto->titulo               = $request->input('tituloEditar');
            $producto->subtitulo            = $request->input('subtituloEditar');
            $producto->slug                 = Str::slug($request->input('tituloEditar'));
            $producto->contenido            = $request->input('contenidoEditar');

            if ($request->hasFile('imagenEditar')){
                $nombreImagen = Storage::disk('panel')->putFile('producto',$request->file('imagenEditar'));
                $producto->imagen = basename($nombreImagen);
            }


            $producto->modelo_desde            = $request->input('modelo_desdeEditar');
            $producto->modelo_hasta            = $request->input('modelo_hastaEditar');
            $producto->caudal_desde            = $request->input('caudal_desdeEditar');
            $producto->caudal_hasta            = $request->input('caudal_hastaEditar');
            $producto->presion_desde            = $request->input('presion_desdeEditar');
            $producto->presion_hasta            = $request->input('presion_hastaEditar');

            if ($request->hasFile('pdfEditar')){
                $nombreImagen = Storage::disk('panel')->putFile('producto',$request->file('pdfEditar'));
                $producto->pdf = basename($nombreImagen);
            }

            $producto->estado               = $request->input('estadoEditar');

            $producto->update();

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
            $producto = Producto::query()->findOrFail($request->input('idproducto'));
            $producto->estado    = 1;
            $producto->update();

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
            $producto = Producto::query()->findOrFail($request->input('idproducto'));
            $producto->estado    = 0;

            $producto->update();

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


    public function eliminarPdf(Request $request)
    {
        try {
            $producto = Producto::query()->findOrFail($request->input('idproducto'));
            $producto->pdf    = '';
            $producto->update();

            return response()->json([
                "mensaje"=> "Registro actualizado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                "mensaje"=> "No se pudo actualizado el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }
    }



}

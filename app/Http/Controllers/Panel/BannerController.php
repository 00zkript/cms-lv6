<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $banners = Banner::query()
            ->orderBy('pagina')
            ->orderBy('posicion', 'ASC')
            ->paginate(10, ['*'], 'pagina', 1);

        return view('panel.banner.index')->with(compact('banners'));
    }


    public function listar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $banners = Banner::query()
            ->when(!empty($txtBuscar), function ($query) use ($txtBuscar) {
                return $query->where('pagina', 'like', "%$txtBuscar%" );
            })
            ->orderBy('posicion', 'ASC')
            ->paginate($cantidadRegistros, ['*'], 'pagina', $paginaActual);

        return response()->json(view('panel.banner.listado')->with(compact('banners'))->render());


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(BannerRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }



        try {

            $banner = new Banner;
            $banner->pagina    = $request->input('pagina');
            $banner->contenido = $request->input('contenido');
            $banner->ruta      = $request->input('ruta');
            $banner->posicion  = $request->input('posicion');
            $banner->estado    = $request->input('estado');
            // $banner->video = $request->input('video');

            if ($request->hasFile('imagen')) {
                // $imagen = Storage::disk('panel')->putFile('banner', $request->file('imagen'));
                $imagen = $request->file('imagen')->store('banner','panel');
                $banner->imagen = basename($imagen);
            }


            $banner->save();

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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $idbanner = $request->input('idbanner');
        $banner = Banner::query()->find($idbanner);

        if(!$banner){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($banner);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $idbanner = $request->input('idbanner');
        $banner = Banner::query()->find($idbanner);

        if(!$banner){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }

        return response()->json($banner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(BannerRequest $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        try {

            $banner            = Banner::query()->findOrFail($request->input('idbanner'));
            $banner->pagina    = $request->input('paginaEditar');
            $banner->contenido = $request->input('contenidoEditar');
            $banner->ruta      = $request->input('rutaEditar');
            $banner->posicion  = $request->input('posicionEditar');
            $banner->estado    = $request->input('estadoEditar');
            // $banner->video = $request->input('videoEditar');

            if ($request->hasFile('imagenEditar')) {


                if (Storage::disk('panel')->exists('banner/' . $banner->imagen)) {
                    Storage::disk('panel')->delete('banner/' . $banner->imagen);
                }


                $imagen = $request->file('imagenEditar')->store('banner','panel');
                $banner->imagen = basename($imagen);
            }


            $banner->update();

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
        if (!$request->ajax()) {
            return abort(404);
        }

        try {

            $banner = Banner::query()->findOrFail($request->input('idbanner'));
            $banner->estado = 1;
            $banner->update();



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
        if (!$request->ajax()) {
            return abort(404);
        }

        try {

            $banner = Banner::query()->findOrFail($request->input('idbanner'));
            $banner->estado = 0;
            $banner->update();



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

        /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try{

            $banner = Banner::query()->findOrFail($request->input('idbanner'));

            if (Storage::disk('panel')->exists('banner/' . $banner->imagen)) {
                Storage::disk('panel')->delete('banner/' . $banner->imagen);
            }

            $banner->delete();

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

    public function removerImagen(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }




        try {

            $banner = Banner::find($request->input('idbanner'));
            Storage::disk('panel')->delete('banner/' . $banner->imagen);
            $banner->imagen = null;
            $banner->update();

            return response()->json([
                "mensaje" => "Imagen eliminada con exito"
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo eliminar la imagen del registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }



    }


    public function getPosicion(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $pagina = $request->input('pagina');

        $cantidad = Banner::query()
            ->where('pagina', $pagina)
            ->count();

        return response()->json([
            "posicion_maxima" => $cantidad + 1
        ]);

    }


}

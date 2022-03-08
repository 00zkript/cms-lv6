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

        $banners = DB::table('banner AS b')
            ->selectRaw('b.*')
            ->orderBy('b.orden', 'ASC')
            ->orderBy('b.pagina')
            ->paginate(10, ['*'], 'pagina', 1);

        return view('panel.banner.index')->with(compact('banners'));
    }


    public function listar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $cantidadRegistros = $request->cantidadRegistros;
        $paginaActual = $request->paginaActual;
        $txtBuscar = trim($request->txtBuscar);

        $banners = DB::table('banner AS b')
            ->selectRaw('b.*')
            ->when(!empty($txtBuscar), function ($query) use ($txtBuscar) {
                return $query->whereRaw('b.pagina LIKE ? ', ["%" . $txtBuscar . "%"]);
            })
            ->orderBy('b.orden', 'ASC')
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

        $banner = new Banner;
        $banner->pagina = $request->input('pagina');

        if ($request->hasFile('imagen')) {
            $imagen = Storage::disk('panel')->putFile('banner', $request->file('imagen'));
            $banner->imagen = basename($imagen);
        }

        $banner->video = $request->input('video');

        $banner->contenido = $request->input('contenido');
        $banner->orden = $request->input('orden');
        $banner->estado = $request->input('estado');
        $banner->save();

        return response()->json(["data" => "Nuevo registro guardado con exito."], 200);


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

        $banner = Banner::find($idbanner);

        if (!empty($banner)) {

            return response()->json(["data" => $banner], 200);

        } else {

            return response()->json(["data" => "Registro no encontrado"], 400);

        }


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

        $banner = Banner::find($idbanner);

        if (!empty($banner)) {

            return response()->json(["data" => $banner], 200);

        } else {

            return response()->json(["data" => "Registro no encontrado"], 400);

        }


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

        $idbanner = $request->input('idbanner');

        $banner = Banner::find($idbanner);

        if (!empty($banner)) {


            $banner->pagina = $request->input('paginaEditar');

            if ($request->hasFile('imagenEditar')) {

                if (Storage::disk('panel')->exists('banner/' . $banner->imagen)) {
                    Storage::disk('panel')->delete('banner/' . $banner->imagen);
                }


                $imagen = Storage::disk('panel')->putFile('banner', $request->file('imagenEditar'));
                $banner->imagen = basename($imagen);
            }

            $banner->video = $request->input('videoEditar');

            $banner->contenido = $request->input('contenidoEditar');
            $banner->orden = $request->input('ordenEditar');
            $banner->estado = $request->input('estadoEditar');
            $banner->update();


            return response()->json(["data" => "Registro modificado con exito."], 200);

        } else {
            return response()->json(["data" => "El registro no pudo ser modificado"], 400);
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

        $idbanner = $request->input('idbanner');

        $banner = Banner::find($idbanner);

        if (!empty($banner)) {

            if (Storage::disk('panel')->exists('banner/' . $banner->imagen)) {
                Storage::disk('panel')->delete('banner/' . $banner->imagen);
            }

            $banner->delete();

            return response()->json(["data" => "Registro eliminado con exito"], 200);

        } else {

            return response()->json(["data" => "Registro no encontrado"], 400);

        }


    }


    public function habilitar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $idbanner = $request->input('idbanner');

        $banner = Banner::find($idbanner);

        if (!empty($banner)) {

            $banner->estado = 1;
            $banner->update();

            return response()->json(["data" => "Registro habilitado con exito"], 200);

        } else {

            return response()->json(["data" => "Registro no encontrado"], 400);

        }


    }

    public function inhabilitar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $idbanner = $request->input('idbanner');

        $banner = Banner::find($idbanner);

        if (!empty($banner)) {

            $banner->estado = 0;
            $banner->update();

            return response()->json(["data" => "Registro inhabilitado con exito"], 200);

        } else {

            return response()->json(["data" => "Registro no encontrado"], 400);

        }


    }


    public function removerImagen(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        $banner = Banner::find($request->input('idbanner'));

        if (!empty($banner)) {

            Storage::disk('panel')->delete('banner/' . $banner->imagen);
            $banner->imagen = null;
            $banner->update();


            return response()->json(["data" => "Imagen eliminada con exito"], 200);

        } else {

            return response()->json(["data" => "Ocurrio algun error"], 400);

        }


    }


    public function cantidadBanners(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $pagina = $request->input('pagina');

        $cantidad = DB::table('banner')
            ->where('pagina', $pagina)
            ->count();

        return response()->json($cantidad + 1);

    }


}

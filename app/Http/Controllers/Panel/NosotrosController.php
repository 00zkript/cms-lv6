<?php

namespace App\Http\Controllers\Panel;

use App\Models\Nosotros;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NosotrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nosotros = DB::table('nosotros')
            ->first();



        return view('panel.nosotros.index')->with(compact('nosotros'));
    }

   function update(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $nosotros = Nosotros::findOrFail($request->idnosotros);
        $nosotros->vision = $request->vision;
        $nosotros->mision = $request->mision;
        $nosotros->quienes_somos = $request->somos;
        $nosotros->update();

        return response()->json(['mensaje' => 'Información modificada satisfactoriamente']);



    }


}

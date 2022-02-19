<?php

namespace App\Http\Controllers\Panel;

use App\Models\Empresa;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageHelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmpresaController extends Controller
{

    public function index()
    {
        $empresa = DB::table('empresa')
            ->first();

        return view('panel.empresa.index')->with(compact('empresa'));
    }

    public function update(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        $empresa = Empresa::findOrFail($request->input('idempresa'));


        if ($request->hasFile('favicon')){
            $nombreImagen = Storage::disk('panel')->putFile('empresa',$request->file('favicon'));
            $empresa->favicon = basename($nombreImagen);
        }

        if ($request->hasFile('logo')){

            $nombreImagen = Storage::disk('panel')->putFile('empresa',$request->file('logo'));
            $empresa->logo = basename($nombreImagen);

        }


        if($request->hasFile('logo2')){
             $nombreImagen = Storage::disk('panel')->putFile('empresa',$request->file('logo2'));
             $empresa->logo2 = basename($nombreImagen);
         }


        $empresa->titulo_general   = $request->input('tituloGeneral');
        $empresa->seo_keywords    = $request->input('keywords');
        $empresa->seo_description = $request->input('description');
        $empresa->seo_author      = $request->input('author');
        $empresa->seguimiento_head   = $request->input('seguimientoHead');
        $empresa->seguimiento_body   = $request->input('seguimientoBody');


        $empresa->estado = 1;
        $empresa->update();

        return response()->json(['mensaje' => 'Información modificada satisfactoriamente']);



    }

}

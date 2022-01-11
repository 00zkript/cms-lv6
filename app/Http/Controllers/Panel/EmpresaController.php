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
    use ImageHelperTrait;

    public function index()
    {
        $empresa = DB::table('empresa')
            ->first();

        $empresa->faviconData = $this->oneFileData('empresa',$empresa->favicon);
        $empresa->logoData = $this->oneFileData('empresa',$empresa->logo);
        $empresa->logo_footerData = $this->oneFileData('empresa',$empresa->logo_footer);

        return view('panel.empresa.index')->with(compact('empresa'));
    }

    public function update(Request $request)
    {
        if ($request->ajax()){

            $empresa = Empresa::findOrFail($request->input('idempresa'));

            // if($request->hasFile('logoFooter')){
            //     $nombreImagen = Storage::disk('panel')->putFile('empresa',$request->file('logoFooter'));
            //     $empresa->logo_footer = basename($nombreImagen);
            // }

            if ($request->hasFile('favicon')){
                $nombreImagen = Storage::disk('panel')->putFile('empresa',$request->file('favicon'));
                $empresa->favicon = basename($nombreImagen);
            }

            if ($request->hasFile('logo')){

                $nombreImagen = Storage::disk('panel')->putFile('empresa',$request->file('logo'));
                $empresa->logo = basename($nombreImagen);

            }
            $empresa->titulo_pagina   = $request->input('tituloPagina');
            $empresa->seo_keywords    = $request->input('keywords');
            $empresa->seo_description = $request->input('description');
            $empresa->seo_author      = $request->input('author');
            $empresa->seguimiento_head   = $request->input('seguimientoHead');
            $empresa->seguimiento_body   = $request->input('seguimientoBody');


            $empresa->estado = 1;
            $empresa->update();

            return response()->json('Información modificada satisfactoriamente');


        }else{
            return back();
        }
    }

}

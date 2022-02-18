<?php

namespace App\Http\Controllers\Panel;

use App\Models\Contacto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactoController extends Controller
{
    public function index()
    {
        $contacto = DB::table('contacto')
            ->first();

        return view('panel.contacto.index')->with(compact('contacto'));
    }

    public function update(Request $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }

        $contacto = Contacto::findOrFail($request->idcontacto);
        $contacto->direccion = $request->input('direccion');
        $contacto->telefono  = $request->input('telefono');
        $contacto->telefono2 = $request->input('telefono2');
        $contacto->telefono3 = $request->input('telefono3');
        $contacto->whatsapp  = $request->input('whatsapp');
        $contacto->correo    = $request->input('correo');
        $contacto->ubicacion = $request->input('googleMaps');
        $contacto->facebook  = $request->input('facebook');
        $contacto->instagram = $request->input('instagram');
        $contacto->twitter   = $request->input('twitter');
        $contacto->youtube   = $request->input('youtube');
        $contacto->linkedin  = $request->input('linkedin');
        $contacto->pinterest = $request->input('pinterest');
        $contacto->update();

        return response()->json(['mensaje' => 'Información modificada satisfactoriamente']);


    }
}

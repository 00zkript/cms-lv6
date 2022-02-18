<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\ConfirguracionRequest;
use App\Http\Traits\ImageHelperTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfiguracionController extends Controller
{


    public function edit(Request $request)
    {

//        $usuario = User::query()->find(auth()->id());
        $usuario = auth()->user();


        return view('panel.configuracion.index')->with(compact('usuario'));


    }



    public function update(ConfirguracionRequest $request)
    {
        if (!$request->ajax()){
            return abort(403);
        }


        $usuario =  User::findOrFail($request->input('idusuario'));
        $usuario->usuario = $request->input('usuarioEditar');

        if (!empty($request->input('claveEditar'))){
            $usuario->clave = encrypt($request->input('claveEditar'));
        }

        $usuario->nombres   = $request->input('nombresEditar');
        $usuario->apellidos = $request->input('apellidosEditar');
        $usuario->email    = $request->input('correoEditar');

        if ($request->hasFile('imagenEditar')){

            $nombreImagen  = Storage::disk('panel')->putFile('usuario',$request->file('imagenEditar'));
            $usuario->imagen = basename($nombreImagen);
        }

        $usuario->update();

        return response()->json(['mensaje' => 'Usuario modificado satisfactoriamente']);


    }
}

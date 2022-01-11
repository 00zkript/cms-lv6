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

    use ImageHelperTrait;

    public function edit(Request $request)
    {

        $usuario = User::query()->find(auth()->id());

        $usuario->fotoData = $this->oneFileData('usuario',$usuario->foto);




        return view('panel.configuracion.index')->with(compact('usuario'));


    }



    public function update(ConfirguracionRequest $request)
    {


            $usuario =  User::findOrFail($request->input('idusuario'));
            $usuario->usuario = $request->input('usuarioEditar');

            if (!empty($request->input('claveEditar'))){
                $usuario->clave = encrypt($request->input('claveEditar'));
            }

            $usuario->nombres   = $request->input('nombresEditar');
            $usuario->apellidos = $request->input('apellidosEditar');
            $usuario->email    = $request->input('correoEditar');

            if ($request->hasFile('fotoEditar')){

                $nombreImagen  = Storage::disk('panel')->putFile('usuario',$request->file('fotoEditar'));
                $usuario->foto = basename($nombreImagen);
            }

            $usuario->update();

            return response()->json('Usuario modificado satisfactoriamente');


    }
}

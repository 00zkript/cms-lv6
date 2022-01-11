<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return view('panel.seguridad.login');
        }else{
           return redirect()->route('home.index');
        }

    }

    public function verificar(LoginRequest $request)
    {
        if ($request->ajax()){

            try{

                $usuario = $request->usuario;
                $clave = $request->clave;
                $recuerdame = $request->recuerdame;
                $respuesta = [];

                $usuarioExistente = DB::table('usuario')
                    ->where('usuario',$usuario)
                    ->where('estado',1)
                    ->first();


                if (!empty($usuarioExistente) && decrypt($usuarioExistente->password) == $clave){

                    $respuesta['error'] = false;
                    $respuesta['mensaje'] = 'Usuario autenticado, redirigiendo...';

                    auth()->loginUsingId($usuarioExistente->idusuario,$recuerdame);

                }else{
                    $respuesta['error'] = true;
                    $respuesta['mensaje'] = 'Usuario incorrecto';
                }

                return response()->json($respuesta);

            }catch (\Throwable $t){
                die($t->getMessage());
            }

        }else{
            return back();
        }
    }

    public function salir()
    {
        session()->flush();
        auth()->logout();
        return redirect()->route('login-panel');
    }
}

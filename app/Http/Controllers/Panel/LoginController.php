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
        }


        return redirect()->route('home.index');

    }

    public function verificar(LoginRequest $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try{

            $usuario    = $request->input('usuario');
            $clave      = $request->input('clave');
            $recuerdame = $request->input('recuerdame');

            $usuarioExistente = DB::table('usuario')
                ->where('usuario',$usuario)
                ->where('estado',1)
                ->first();

            $mensaje = 'Usuario incorrecto';
            $status = 400;

            if (!empty($usuarioExistente) && decrypt($usuarioExistente->password) == $clave){
                auth()->loginUsingId($usuarioExistente->idusuario,$recuerdame);

                $mensaje ='Usuario autenticado, redirigiendo...';
                $status = 200;

            }


            return response()->json(['mensaje' => $mensaje ], $status);

        }catch (\Throwable $t){
            die($t->getMessage());
        }


    }

    public function salir()
    {
        session()->flush();
        auth()->logout();
        return redirect()->route('login-panel');
    }
}

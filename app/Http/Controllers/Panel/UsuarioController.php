<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\UsuarioRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{

    public function index()
    {

        $roles = DB::table('rol')
            ->where('estado',1)
            //->where('idrol',1)
            ->get();

        $usuarios = DB::table('usuario AS u')
            ->join('rol AS r','u.idrol','=','r.idrol')
            ->selectRaw('u.*,r.rol AS rol')
            ->orderBy('u.idusuario','DESC')
            ->paginate(10,['*'],'pagina',1);

        return view('panel.usuario.index')->with(compact('roles','usuarios'));

    }

    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }


       $cantidadRegistros = $request->cantidadRegistros;
       $paginaActual = $request->paginaActual;
       $txtBuscar = $request->txtBuscar;

       $usuarios = DB::table('usuario AS u')
           ->join('rol AS r','u.idrol','=','r.idrol')
           ->selectRaw('u.*,r.rol AS rol')
           ->where('r.rol','LIKE','%'.$txtBuscar.'%')
           ->orWhere('u.usuario','LIKE','%'.$txtBuscar.'%')
           ->orderBy('u.idusuario','DESC')
           ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);


       return response()->json(view('panel.usuario.listado')->with(compact('usuarios'))->render());





    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $usuario = new User();
        $usuario->idrol = $request->input('rol');
        $usuario->usuario = $request->input('usuario');
        $usuario->clave = encrypt($request->input('clave'));
        $usuario->nombres = $request->input('nombres');
        $usuario->apellidos = $request->input('apellidos');
        $usuario->correo = $request->input('correo');

        if ($request->hasFile('foto')){
            $nombreImagen = Storage::disk('panel')->put('usuario',$request->file('foto'));
            $usuario->foto = basename($nombreImagen);
        }

        $usuario->estado = $request->input('estado');
        $usuario->save();

        return response()->json(['mensaje' =>'Usuario registrado satisfactoriamente']);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $usuario = DB::table('usuario AS u')
            ->join('rol AS r','u.idrol','=','r.idrol')
            ->selectRaw('u.*,r.rol')
            ->where('u.idusuario',$request->idusuario)
            ->first();

        if (!empty($usuario)){
            return response()->json($usuario);

        }

        return response()->json(['mensaje' => "Este registro no existe"],400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $usuario = DB::table('usuario')
            ->where('idusuario',$request->idusuario)
            ->first();

        if (!empty($usuario)){

            return response()->json($usuario);

        }

        return response()->json(['mensaje' => "Este registro no existe"],400);



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioRequest $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $usuario =  User::findOrFail($request->input('idusuario'));
        $usuario->idrol = $request->input('rolEditar');
        $usuario->usuario = $request->input('usuarioEditar');

        if (!empty($request->input('claveEditar'))){
            $usuario->clave = encrypt($request->input('claveEditar'));
        }

        $usuario->nombres = $request->input('nombresEditar');
        $usuario->apellidos = $request->input('apellidosEditar');
        $usuario->correo = $request->input('correoEditar');

        if ($request->hasFile('fotoEditar')){

            if (Storage::disk('panel')->exists('usuario/'.$usuario->foto) ){
                Storage::disk('pane')->delete("usuario/".$usuario->foto);
            }

            $nombreImagen = Storage::disk('panel')->put('usuario',$request->file('fotoEditar'));
            $usuario->foto = basename($nombreImagen);

        }

        $usuario->estado = $request->input('estadoEditar');

        $usuario->update();

        return response()->json(['mensaje' =>'Usuario modificado satisfactoriamente']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function habilitar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $usuario = DB::table('usuario')
            ->where('idusuario',$request->idusuario)
            ->first();

        if (!empty($usuario)){

            $usuario = User::findOrFail($request->idusuario);
            $usuario->estado = 1;
            $usuario->update();

            return response()->json(['mensaje'=>'Registro habilitado satisfactoriamente']);

        }


        return response()->json(['mensaje' =>"Este registro no existe"],400);



    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) {
            return back();
        }

        $usuario = DB::table('usuario')
            ->where('idusuario', $request->idusuario)
            ->first();

        if (!empty($usuario)) {

            $usuario = User::findOrFail($request->idusuario);
            $usuario->estado = 0;
            $usuario->update();

            return response()->json(['mensaje' => 'Registro inhabilitado satisfactoriamente']);

        }
        return response()->json(['mensaje' => "Este registro no existe"], 400);
    }


}

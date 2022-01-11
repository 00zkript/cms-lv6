<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Ause App\Http\Requests\Panel\UsuarioRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
       if ($request->ajax()){

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



       }else{
           return back();
       }

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
        if ($request->ajax()){

            $usuario = new User;
            $usuario->idrol = $request->rol;
            $usuario->usuario = $request->usuario;
            $usuario->clave = encrypt($request->clave);
            $usuario->nombres = $request->nombres;
            $usuario->apellidos = $request->apellidos;
            $usuario->correo = $request->correo;

            if ($request->hasFile('foto')){
                $foto = $request->file('foto');
                $nombreFoto = time().'.'.$foto->getClientOriginalExtension();
                $foto->move(public_path('panel/img/usuarios/'),$nombreFoto);
                $usuario->foto = $nombreFoto;
            }

            $usuario->estado = $request->estado;

            $usuario->save();

            return response()->json('Usuario registrado satisfactoriamente');

        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax()){

            $usuario = DB::table('usuario AS u')
                ->join('rol AS r','u.idrol','=','r.idrol')
                ->selectRaw('u.*,r.rol')
                ->where('u.idusuario',$request->idusuario)
                ->first();

            if (!empty($usuario)){

                return response()->json($usuario);

            }else{
                return response()->json("Este registro no existe",400);
            }

        }else{
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if ($request->ajax()){

            $usuario = DB::table('usuario')
                ->where('idusuario',$request->idusuario)
                ->first();

            if (!empty($usuario)){

                return response()->json($usuario);

            }else{
                return response()->json("Este registro no existe",400);
            }

        }else{
            return back();
        }
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
        if ($request->ajax()){

            $usuario =  User::findOrFail($request->idusuario);
            $usuario->idrol = $request->rolEditar;
            $usuario->usuario = $request->usuarioEditar;

            if (!empty($request->claveEditar)){
                $usuario->clave = encrypt($request->claveEditar);
            }

            $usuario->nombres = $request->nombresEditar;
            $usuario->apellidos = $request->apellidosEditar;
            $usuario->correo = $request->correoEditar;

            if ($request->hasFile('fotoEditar')){

                if (File::exists(public_path('panel/img/usuarios/'.$usuario->foto))){
                    File::delete(public_path('panel/img/usuarios/'.$usuario->foto));
                }

                $foto = $request->file('fotoEditar');
                $nombreFoto = time().'.'.$foto->getClientOriginalExtension();
                $foto->move(public_path('panel/img/usuarios/'),$nombreFoto);
                $usuario->foto = $nombreFoto;
            }

            $usuario->estado = $request->estadoEditar;

            $usuario->update();

            return response()->json('Usuario modificado satisfactoriamente');

        }else{
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function habilitar(Request $request)
    {
        if ($request->ajax()){

            $usuario = DB::table('usuario')
                ->where('idusuario',$request->idusuario)
                ->first();

            if (!empty($usuario)){

                $usuario = User::findOrFail($request->idusuario);
                $usuario->estado = 1;
                $usuario->update();

                return response()->json('Registro habilitado satisfactoriamente');

            }else{
                return response()->json("Este registro no existe",400);
            }

        }
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()){

            $usuario = DB::table('usuario')
                ->where('idusuario',$request->idusuario)
                ->first();

            if (!empty($usuario)){

                $usuario = User::findOrFail($request->idusuario);
                $usuario->estado = 0;
                $usuario->update();

                return response()->json('Registro inhabilitado satisfactoriamente');

            }else{
                return response()->json("Este registro no existe",400);
            }

        }
    }

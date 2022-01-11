<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactoEmail;

class ContactoController extends Controller
{
    public function index()
    {

        return view('web.contacto.index');
    }



    public function enviar( Request $request)
    {
        try {

            Mail::send(new ContactoEmail($request->all()));

            return response()->json(["mensaje" => "Se envió correctamente la solicitud de contacto."]);

        } catch (\Throwable $th) {

            return response()->json([
                "mensaje"=> "No se pudo enviar tu solicitud, recargue y prueba nuevamente."
            ],400);

        }



    }



}

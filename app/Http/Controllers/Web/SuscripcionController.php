<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\SuscribirseMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SuscripcionController extends Controller
{

    public function enviar(Request $request)
    {
        try {

            Mail::send(new SuscribirseMail($request->all()));

            return response()->json(['mensaje' => "Se envió correctamente la solicitud de suscripción."]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo enviar tu solicitud, recargue y prueba nuevamente."
            ],400);

        }



    }




}

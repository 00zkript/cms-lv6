<?php

use App\Models\Contacto;
use App\Models\Empresa;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        User::query()->create([
            'nombres' => "Admin",
            'apellidos' => "",
            'usuario' => "admin",
            'email' => "admin@example.com",
            'password' => encrypt('123456789'),
            'estado' => 1,
            'email_verified_at' => now(),
        ]);
        Empresa::query()->create([
            "titulo_general" =>"empresa",
            "nombre" =>"empresa",
            "favicon" => "favicon-default.jpg",
            "logo" => "logo-default.jpg",
            "logo2" => "logo-default2.jfif",
        ]);
        Contacto::query()->create([
            "correo" => "contacto@exaple.com"
        ]);

        \App\Models\MetodoPago::query()->create([
            "nombre" => "MERCADO PAGO",
            "estado" => 1
        ]);

        $statusEnvios = ["en espera de envío", "enviado", "entregado", "devuelto", "no se entrego",];

        foreach ($statusEnvios as $item){
            $statusEnvio = new \App\Models\StatusEnvio();
            $statusEnvio->nombre = $item;
            $statusEnvio->estado = 1;
            $statusEnvio->save();
        }


        $statusPagos = ["En espera de pago", "pagado", "cancelado", "reembolsado"];
        foreach ($statusPagos as $item){
            $statusPago = new \App\Models\StatusPago();
            $statusPago->nombre = $item;
            $statusPago->estado = 1;
            $statusPago->save();
        }

        $statusVentas = ["recibido", "finalizado", "cancelado",];
        foreach ($statusVentas as $item){
            $statusVenta = new \App\Models\StatusVenta();
            $statusVenta->nombre = $item;
            $statusVenta->estado = 1;
            $statusVenta->save();
        }

        $tiposComprobante = ["boleta","factura"];
        foreach ($tiposComprobante as $key => $item){
            $tipoComprobante = new \App\Models\TipoComprobante();
            $tipoComprobante->nombre = $item;
            $tipoComprobante->nro_correlativo = str_pad($key+1,3,0,STR_PAD_LEFT);
            $tipoComprobante->nro_serie = 0;
            $tipoComprobante->estado = 1;
            $tipoComprobante->save();
        }

        $tiposDescuentos = [ "Moneda S/.", "Porcentaje %" ];
        foreach ($tiposDescuentos as $key => $item){
            $tipoDescuento = new \App\Models\TipoDescuento();
            $tipoDescuento->nombre = $item;
            $tipoDescuento->estado = 1;
            $tipoDescuento->save();
        }


        $tiposUos = [ "Unico", "Múltiple" ];
        foreach ($tiposUos as $key => $item){
            $tipoUso = new \App\Models\TipoUso();
            $tipoUso->nombre = $item;
            $tipoUso->estado = 1;
            $tipoUso->save();
        }


        $tiposdocumentoIdentidad = [ "DNI", "Pasaporte", "Carnet de Extanjeria" ];
        foreach ($tiposdocumentoIdentidad as $key => $item){
            $docidentidad = new \App\Models\TipoDocumentoIdentidad();
            $docidentidad->nombre = $item;
            $docidentidad->estado = 1;
            $docidentidad->save();
        }



    }
}

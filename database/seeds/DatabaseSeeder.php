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

        User::create([
            'nombres' => "Admin",
            'apellidos' => "",
            'usuario' => "admin",
            'email' => "admin@example.com",
            'password' => encrypt('123456789'),
            'estado' => 1,
            'email_verified_at' => now(),
        ]);

        Empresa::create([
            "titulo_general" =>"empresa",
            "nombre" =>"empresa",
        ]);


        Contacto::create([
            "correo" => "contacto@exaple.com"
        ]);

    }
}

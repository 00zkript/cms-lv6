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



    }
}

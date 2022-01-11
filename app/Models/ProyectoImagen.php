<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoImagen extends Model
{
    protected $table = 'proyecto_imagen';
    protected $primaryKey = 'idproyecto_imagen';
    public $timestamps = false;
    protected $guarded = [];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioImagen extends Model
{
    protected $table = 'servicio_imagen';
    protected $primaryKey = 'idservicio_imagen';
    public $timestamps = false;
    protected $guarded = [];
}

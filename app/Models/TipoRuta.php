<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoRuta extends Model
{
    protected $table = "tipo_ruta";
    protected $priamryKey = "idtipo_ruta";
    public $timestamps = false;
    protected $guarded = [];

}

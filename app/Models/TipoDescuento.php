<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDescuento extends Model
{
    protected $table = 'tipo_descuento';
    protected $primaryKey = 'idtipo_descuento';
    public $timestamps = false;
    protected $guarded = [];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoComprobante extends Model
{
    protected $table = 'tipo_comprobante';
    protected $primaryKey = 'idtipo_comprobante';
    public $timestamps = false;
    protected $guarded = [];
}

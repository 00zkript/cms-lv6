<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    protected $table = 'venta_detalle';
    protected $primaryKey = 'idventa_detalle';
    public $timestamps = false;
    protected $guarded = [];
}

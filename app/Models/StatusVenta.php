<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusVenta extends Model
{
    protected $table = 'status_venta';
    protected $primaryKey = 'idstatus_venta';
    public $timestamps = false;
    protected $guarded = [];
}

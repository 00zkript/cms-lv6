<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPago extends Model
{
    protected $table = 'status_pago';
    protected $primaryKey = 'idstatus_pago';
    public $timestamps = false;
    protected $guarded = [];
}

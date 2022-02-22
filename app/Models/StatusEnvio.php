<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusEnvio extends Model
{
    protected $table = 'status_envio';
    protected $primaryKey = 'idstatus_envio';
    public $timestamps = false;
    protected $guarded = [];
}

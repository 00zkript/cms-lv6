<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoUso extends Model
{
    protected $table = 'tipo_uso';
    protected $primaryKey = 'idtipo_uso';
    public $timestamps = false;
    protected $guarded = [];
}

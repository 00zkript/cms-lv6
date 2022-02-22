<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumentoIdentidad extends Model
{
    protected $table = 'tipo_documento_identidad';
    protected $primaryKey = 'idtipo_documento_identidad';
    public $timestamps = false;
    protected $guarded = [];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagina extends Model
{
    protected $table = 'pagina';
    protected $primaryKey = 'idpagina';
    public $timestamps = false;
    protected $guarded = [];
}

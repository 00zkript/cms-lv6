<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marca';
    protected $primaryKey = 'idmarca';
    public $timestamps = false;
    protected $guarded = [];
}

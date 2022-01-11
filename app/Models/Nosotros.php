<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nosotros extends Model
{
    protected $table = 'nosotros';
    protected $primaryKey = 'idnosotros';
    public $timestamps = false;
    protected $guarded = [];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $table = 'cupon';
    protected $primaryKey = 'idcupon';
    public $timestamps = false;
    protected $guarded = [];
}

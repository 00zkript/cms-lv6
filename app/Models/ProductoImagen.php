<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoImagen extends Model
{
    protected $table = 'producto_imagen';
    protected $primaryKey = 'idproducto_imagen';
    public $timestamps = false;
    protected $guarded = [];
}

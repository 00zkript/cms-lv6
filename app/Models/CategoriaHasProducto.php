<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaHasProducto extends Model
{
    protected $table = 'categoria_has_producto';
    protected $primaryKey = 'idcategoria_has_producto';
    public $timestamps = false;
    protected $guarded = [];
}

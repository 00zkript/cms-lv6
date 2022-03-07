<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'idproducto';
    public $timestamps = false;
    protected $guarded = [];


    public function categorias()
    {
        return $this->belongsToMany(CategoriaProducto::class,'categoria_has_producto','idproducto','idcategoria');
    }

    public function imagenes()
    {
        return $this->hasMany(ProductoImagen::class,'idproducto','idproducto');
    }

    public function marca()
    {
        return $this->hasOne(Marca::class,'idmarca','idmarca');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyecto';
    protected $primaryKey = 'idproyecto';
    public $timestamps = false;
    protected $guarded = [];


    public function imagenes()
    {
        return $this->hasMany(ProyectoImagen::class,'idproyecto','idproyecto')->orderBy('posicion');
    }
}

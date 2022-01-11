<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerImagen extends Model
{
    protected $table = 'banner_imagen';
    protected $primaryKey = 'idbanner_imagen';
    public $timestamps = false;
    protected $guarded = [];
}

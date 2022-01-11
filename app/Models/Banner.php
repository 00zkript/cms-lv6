<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';
    protected $primaryKey = 'idbanner';
    public $timestamps = false;
    protected $guarded = [];
}

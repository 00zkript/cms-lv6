<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'idmenu';
    public $timestamps = false;
    protected $guarded = [];


    public static function getRoutesInternal(){
        $rutaInterna = array();

        foreach (Route::getRoutes() as $k => $route) {

            $name = $route->getName();

            if ( strpos($name,"web.") !== false && substr_count($name,".") === 1){
                $url = route($name);



                $rutaInterna[]= (Object)[
                    "key" => $name,
                    "name" => $url,
                ];

            }
        }

        $rutaInterna = (Object)$rutaInterna ;

        return $rutaInterna;
    }

    public function submenu()
    {
        return $this->hasMany(Menu::class,'pariente','idmenu')->with(['submenu'])->where('estado',1)->orderBY('orden');
    }

    public function padre()
    {
        return $this->hasOne(Menu::class,'idmenu','pariente');

    }
}

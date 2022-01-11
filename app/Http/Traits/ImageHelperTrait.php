<?php

namespace App\Http\Traits;

trait ImageHelperTrait
{

    protected function oneFileData($carpeta, $dato, $tipo = null )
    {
        $url = [];
        $datos = [];

        if (!empty($dato)){
                array_push($url, url('/panel/img/'.$carpeta.'/' . $dato));

                $dat = ["caption" => $dato, "width" => "120px", "height" => "120px"];

                if (!empty($tipo)){
                    $dat["type"] = $tipo;
                }

                array_push($datos, $dat);

        }

        return ["url"=>$url,"datos"=>$datos];
    }

    protected function allFilesData($carpeta, $registros, $idregistro, $tipo = null )
    {
        $url = [];
        $datos = [];

        if (count($registros) >0){
            foreach ($registros as $d) {
                array_push($url, url('/panel/img/'.$carpeta.'/' . $d->nombre));

                $dat = ["caption" => $d->nombre, "width" => "120px", "height" => "120px", "key" => $d->$idregistro];

                if (!empty($tipo)){
                    $dat["type"] = $tipo;
                }

                array_push($datos, $dat);
            }
        }

        return ["url"=>$url,"datos"=>$datos];
    }

}

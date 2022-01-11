<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class ConfirguracionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()){

            case 'POST':

                return [
                    'usuario' => 'required|max:50|unique:usuario,usuario',
                    'clave' => 'required|max:20',
                    'nombres' => 'required|max:50',
                    'apellidos' => 'required|max:50',
                    'correo' => 'required|email|max:100|unique:usuario,email',
                    'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10000',
                    // 'estado' => 'required|boolean'
                ];

                break;
            case 'PUT':
                return [
                    'usuarioEditar' => 'required|max:50|unique:usuario,usuario,'.$this->idusuario.',idusuario',
                    'claveEditar' => 'nullable|max:20',
                    'nombresEditar' => 'required|max:50',
                    'apellidosEditar' => 'required|max:50',
                    'correoEditar' => 'required|email|max:100|unique:usuario,email,'.$this->idusuario.',idusuario',
                    'fotoEditar' => 'nullable|image|mimes:jpg,jpeg,png|max:10000',
                    // 'estadoEditar' => 'required|boolean'
                ];
                break;
            default:
                break;
        }

    }

    public function attributes()
    {
        switch ($this->method()){

            case 'POST':

                return [
                    'rol' => 'rol',
                    'usuario' => 'usuario',
                    'clave' => 'clave',
                    'nombres' => 'nombres',
                    'apellidos' => 'apellidos',
                    'correo' => 'correo',
                    'foto' => 'foto',
                    'estado' => 'estado'
                ];

                break;
            case 'PUT':
                return [
                    'rolEditar' => 'rol',
                    'usuarioEditar' => 'usuario',
                    'claveEditar' => 'clave',
                    'nombresEditar' => 'nombres',
                    'apellidosEditar' => 'apellidos',
                    'correoEditar' => 'correo',
                    'fotoEditar' => 'foto',
                    'estadoEditar' => 'estado'
                ];
                break;
            default:
                break;
        }
    }
}

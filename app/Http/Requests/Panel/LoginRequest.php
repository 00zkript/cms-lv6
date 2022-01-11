<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        return [
            'usuario' => 'required|max:50',
            'clave' => 'required|max:50',
            'recuerdame' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'usuario.required' => 'Ingrese un :attribute',
            'clave' => 'Ingrese una clave',
        ];
    }


}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch ($this->method()) {
            case 'POST':
                return true;
            case 'PUT':
            case 'PATCH':
                return true;
            default:
                return false;

        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function store()
    {
        return [
            'nombre' => 'required|string|max:255',
            'email'  => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'admin'  => 'required'
        ];
    }
    public function update()
    {
        return [
            'nombre' => 'required|string|max:255',
            'email'  => ['required','string','email','max:255',Rule::unique('users')->ignore(intval($this->request->get('id')))],
            'admin'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Agrege el nombre de usuario',
            'email.required' => 'Agrege el Correo',
            'email.email' => 'El email no es correcto',
            'email.unique' => 'Ya hay un usuario con este correo',
            'password.required' => 'Agrege una contraseña valida de 6 dijistos',
            'admin.required' => 'Agrege un rol'
        ];
    }
}

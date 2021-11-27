<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagoRequest extends BaseRequest
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
            'nombre' => 'required|string|',
            'apellido' => 'required|string|',
            'cedula' => 'required|string|max:14',
            'articulo' => 'required|string|',
            'abono' => 'nullable|numeric',
            'tipo' => 'required',
            'pago' => 'required|numeric',
            'saldo' => 'required|numeric'
        ];
    }
    public function update()
    {
        return [
            'nombre' => 'required|string|',
            'apellido' => 'required|string|',
            'cedula' => 'required|string|max:14',
            'articulo' => 'required|string|',
            'abono' => 'nullable|numeric',
            'tipo' => 'required',
            'pago' => 'required|numeric',
            'saldo' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Agrege el nombre',
            'apellido.required' => 'Agrege el apellido',
            'cedula.required' => 'Agrege una cedula',
            'cedula.max' => 'EL maximo es de 14 dijistos',
            'articulo.required' => 'Agrege un articulo',
            'tipo.required' => 'Agrege un tipo de recibo',
            'pago.required' => 'Agrege un pago',
            'saldo.required' => 'Agrege un saldo',
        ];
    }
}

<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRoleRequest extends FormRequest
{
    public function authorize()
    {
       
        return true;
    }

    public function rules()
    {
        return [
            'rol' => 'required|in:admin,seller,user'
        ];
    }

    public function messages()
    {
        return [
            'rol.required' => 'El campo rol es obligatorio.',
            'rol.in' => 'El rol debe ser admin, seller o user.',
        ];
    }
}


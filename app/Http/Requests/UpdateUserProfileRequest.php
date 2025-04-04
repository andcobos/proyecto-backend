<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->id == $this->route('id');
    }

    public function rules(): array
    {
        $userId = $this->route('id');

        return [
            'name' => 'sometimes|required|string|min:2|max:255',
            'lastname' => 'sometimes|required|string|min:2|max:255',
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('users')->ignore($userId),
            ],
            'address' => 'sometimes|nullable|string|max:255',
            'phone_number' => 'sometimes|nullable|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio si se incluye.',
            'email.unique' => 'Este correo electrónico ya está en uso.',
            'lastname.required' => 'El apellido es obligatorio si se incluye.',
        ];
    }
}

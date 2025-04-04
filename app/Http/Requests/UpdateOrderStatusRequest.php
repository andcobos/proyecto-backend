<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:pending,processing,shipped,completed,canceled',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'El estado de la orden es obligatorio.',
            'status.in' => 'El estado debe ser uno de: pending, processing, shipped, completed o canceled.',
        ];
    }
}

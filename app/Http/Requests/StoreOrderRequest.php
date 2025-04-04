<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'products.required' => 'Debes seleccionar al menos un producto.',
            'products.*.id.required' => 'Cada producto debe tener un ID.',
            'products.*.id.exists' => 'Al menos uno de los productos no existe.',
            'products.*.quantity.required' => 'Cada producto debe tener una cantidad.',
            'products.*.quantity.min' => 'La cantidad debe ser al menos 1.',
        ];
    }
}

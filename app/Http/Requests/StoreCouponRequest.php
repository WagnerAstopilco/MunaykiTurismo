<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string|min:3|max:255|unique:coupons,code',
            'description' => 'nullable|string|max:1000',
            'discount_percentage' => 'nullable|numeric|between:0,100',
            'max_uses' => 'nullable|numeric|min:1',
            'uses_count' => 'nullable|numeric|min:0',
            'valid_from' => 'nullable|date',
            'valid_to' => 'nullable|date|after_or_equal:valid_from',
        ];
    }
    public function attributes()
    {
        return [
            'code' => 'código',
            'description' => 'descripción',
            'discount_percentage' => 'porcentaje de descuento',
            'max_uses' => 'máximo de usos',
            'uses_count' => 'número de usos',
            'valid_from' => 'fecha de inicio',
            'valid_to' => 'fecha de vencimiento',
        ];
    }
    public function messages()
    {
        return [
            'code.required' => 'El :attribute es obligatorio.',
            'code.unique' => 'El :attribute ya existe.',
            'description.max' => 'La :attribute no puede tener más de :max caracteres.',
            'discount_percentage.between' => 'El :attribute debe estar entre :min y :max.',
            'valid_from.date' => 'La :attribute debe ser una fecha válida.',
            'valid_to.date' => 'La :attribute debe ser una fecha válida.',
            'valid_to.after_or_equal' => 'La :attribute debe ser después o igual a la fecha de inicio.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePromotionRequest extends FormRequest
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
            'name' => 'sometimes|required|string|min:3|max:255',
            'description' => 'sometimes|nullable|string|max:1000',
            'discount_percentage' => 'sometimes|required|integer|between:0,100',
            'valid_from' => 'sometimes|nullable|date',
            'valid_to' => 'sometimes|nullable|date|after_or_equal:valid_from',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre',
            'description' => 'descripción',
            'discount_percentage' => 'porcentaje de descuento',
            'valid_from' => 'fecha de inicio',
            'valid_to' => 'fecha de finalización',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'name.min' => 'El :attribute debe tener al menos :min caracteres.',
            'name.max' => 'El :attribute no puede tener más de :max caracteres.',
            'description.max' => 'La :attribute no puede tener más de :max caracteres.',
            'discount_percentage.required' => 'El :attribute es obligatorio.',
            'discount_percentage.integer' => 'El :attribute debe ser un número entero.',
            'discount_percentage.between' => 'El :attribute debe estar entre :min y :max.',
            'valid_from.date' => 'La :attribute debe ser una fecha válida.',
            'valid_to.date' => 'La :attribute debe ser una fecha válida.',
            'valid_to.after_or_equal' => 'La :attribute debe ser después o igual a la fecha de inicio.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRatingRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'product_id' => 'required|integer|exists:products,id',
            'value' => 'required|integer|between:1,5',
            'comment' => 'nullable|string',
        ];
    }
    public function attributes()
    {
        return [
            'user_id' => 'usuario',
            'product_id' => 'producto',
            'value' => 'valor',
            'comment' => 'comentario',
        ];
    }
    public function messages()
    {
        return [
            'user_id.required' => 'El :attribute es obligatorio.',
            'user_id.exists' => 'El :attribute no es válido.',
            'product_id.required' => 'El :attribute es obligatorio.',
            'product_id.exists' => 'El :attribute no es válido.',
            'value.required' => 'El :attribute es obligatorio.',
            'value.integer' => 'El :attribute debe ser un número entero.',
            'value.between' => 'El :attribute debe estar entre :min y :max.',
            'comment.max' => 'El :attribute no puede tener más de :max caracteres.',
        ];
    }                                                                                                                              
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDestinoRequest extends FormRequest
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
            'place' => 'required|string|min:3|max:255',
            'country' => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'visible_in_main_web' => 'nullable|boolean',
            'image_id' => 'nullable|exists:images,id',
        ];
    }
    public function attributes()
    {
        return [
            'place' => 'lugar',
            'country' => 'país',
            'description' => 'descripción',
            'visible_in_main_web' => 'visible en la web principal',
            'image_id' => 'imagen',
        ];
    }
    public function messages()
    {
        return [
            'place.required' => 'El :attribute es obligatorio.',
            'place.min' => 'El :attribute debe tener al menos :min caracteres.',
            'place.max' => 'El :attribute no puede tener más de :max caracteres.',
            'country.required' => 'El :attribute es obligatorio.',
            'country.min' => 'El :attribute debe tener al menos :min caracteres.',
            'country.max' => 'El :attribute no puede tener más de :max caracteres.',
            'description.max' => 'La :attribute no puede tener más de :max caracteres.',
            'image_id.exists' => 'La :attribute seleccionada no es válida.',
        ];
    }
}

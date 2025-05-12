<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDestinoRequest extends FormRequest
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
            'place' => 'sometimes|required|string|min:3|max:255',
            'country' => 'sometimes|required|string|min:3|max:255|unique:destinos,country,' . $this->destino->id,
            'description' => 'sometimes|nullable|string|max:1000',
            'visible_in_main_web' => 'sometimes|nullable|boolean',
            'image_id' => 'sometimes|nullable|exists:images,id',
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

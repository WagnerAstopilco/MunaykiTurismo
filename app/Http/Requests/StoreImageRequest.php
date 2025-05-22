<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:255',
            'url' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'título',
            'url' => 'URL',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'El :attribute es obligatorio.',
            'title.min' => 'El :attribute debe tener al menos :min caracteres.',
            'title.max' => 'El :attribute no puede tener más de :max caracteres.',
            'url.required' => 'La :attribute es obligatoria.',
            'url.max' => 'La :attribute no puede tener más de :max caracteres.',
        ];
    }
}

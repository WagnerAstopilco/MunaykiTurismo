<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => 'sometimes|required|string|min:3|max:255|unique:categories,name,' . $this->category->id,
            'slug' => 'sometimes|required|string|min:3|max:255|regex:/^[a-z0-9-]+$/|unique:categories,slug,' . $this->category->id,
            'description' => 'sometimes|nullable|string|max:1000',
            'parent_id' => 'sometimes|nullable|exists:categories,id',
            'visible_in_main_web' => 'sometimes|boolean',

        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre',
            'description' => 'descripción',
            'parent_id' => 'categoría padre',
            'visible_in_main_web' => 'visible en la web principal',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'name.min' => 'El :attribute debe tener al menos :min caracteres.',
            'name.max' => 'El :attribute no puede tener más de :max caracteres.',
            'description.max' => 'La :attribute no puede tener más de :max caracteres.',
            'parent_id.exists' => 'La :attribute no es válida.',
        ];
    }
}

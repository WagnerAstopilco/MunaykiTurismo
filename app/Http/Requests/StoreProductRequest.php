<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255|unique:products,name',
            'slug' => 'nullable|string|min:3|max:255|unique:products,slug|regex:/^[a-z0-9-]+$/',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price_PEN' => 'required|numeric|gte:0',
            'price_USD' => 'required|numeric|gte:0',
            'stock' => 'required|integer|min:0',
            'number_of_days' => 'nullable|integer|min:1',
            'number_of_nights' => 'nullable|integer|min:0',
            'number_of_people' => 'nullable|integer|min:1',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,csv,ppt,pptx,txt,zip|max:10240',
            'itinerary' => 'nullable|string',
            'reservation_requirements' => 'nullable|string',
            'reservation_included' => 'nullable|string',
            'destino_id' => 'required|exists:destinos,id',
            'visible_in_main_web' => 'nullable|boolean',

            'image_ids' => 'nullable|array',
            'image_ids.*' => 'exists:images,id',

            'activity_ids' => 'nullable|array',
            'activity_ids.*' => 'exists:activities,id',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre',
            'description' => 'descripción',
            'category_id' => 'categoría',
            'price_PEN' => 'precio en soles',
            'price_USD' => 'precio en dólares',
            'stock' => 'stock',
            'number_of_days' => 'número de días',
            'number_of_nights' => 'número de noches',
            'number_of_people' => 'número de personas',
            'file' => 'archivo',
            'itinerary' => 'itinerario',
            'reservation_requirements' => 'requisitos de reserva',
            'reservation_included' => 'lo que incluye la reserva',
            'destino_id' => 'destino',
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
            'category_id.required' => 'La :attribute es obligatoria.',
            'category_id.exists' => 'La :attribute no es válida.',
            'price_PEN.required' => 'El :attribute es obligatorio.',
            'price_PEN.numeric' => 'El :attribute debe ser un número.',
            'price_PEN.min' => 'El :attribute debe ser al menos :min.',
            'price_USD.required' => 'El :attribute es obligatorio.',
            'price_USD.numeric' => 'El :attribute debe ser un número.',
            'price_USD.min' => 'El :attribute debe ser al menos :min.',
            'stock.required' => 'El :attribute es obligatorio.',
            'stock.integer' => 'El :attribute debe ser un número entero.',
            'stock.min' => 'El :attribute debe ser al menos :min.',
            'number_of_days.integer' => 'El :attribute debe ser un número entero.',
            'number_of_days.min' => 'El :attribute debe ser al menos :min.',
            'number_of_nights.integer' => 'El :attribute debe ser un número entero.',
            'number_of_nights.min' => 'El :attribute debe ser al menos :min.',
            'number_of_people.integer' => 'El :attribute debe ser un número entero.',
            'number_of_people.min' => 'El :attribute debe ser al menos :min.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
            'user_id' => 'sometimes|required|integer|exists:users,id',
            'product_id' => 'sometimes|required|integer|exists:products,id',
            'reservation_date' => 'sometimes|required|date',
            'number_of_people' => 'sometimes|required|integer|min:1',
            'status' => 'sometimes|required|string|in:pendiente,pagada,cancelada',
            'total_price' => 'sometimes|required|numeric|min:0',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date|after_or_equal:start_date',
            'payment_id' => 'sometimes|nullable|integer|exists:payments,id',
        ];
    }
    public function attributes()
    {
        return [
            'user_id' => 'usuario',
            'reservation_date' => 'fecha de reserva',
            'number_of_people' => 'número de personas',
            'status' => 'estado',
            'total_price' => 'precio total',
            'start_date' => 'fecha de inicio',
            'end_date' => 'fecha de fin',
            'payment_id' => 'ID de pago',
        ];
    }
    public function messages()
    {
        return [
            'user_id.required' => 'El :attribute es obligatorio.',
            'user_id.exists' => 'El :attribute no es válido.',
            'reservation_date.required' => 'La :attribute es obligatoria.',
            'reservation_date.date' => 'La :attribute no es válida.',
            'number_of_people.required' => 'El :attribute es obligatorio.',
            'number_of_people.integer' => 'El :attribute debe ser un número.',
            'number_of_people.min' => 'El :attribute debe ser al menos :min.',
            'status.required' => 'El :attribute es obligatorio.',
            'status.in' => 'El :attribute no es válido.',
            'total_price.required' => 'El :attribute es obligatorio.',
            'total_price.numeric' => 'El :attribute debe ser un número.',
            'total_price.min' => 'El :attribute debe ser al menos :min.',
            'start_date.required' => 'La :attribute es obligatoria.',
            'start_date.date' => 'La :attribute no es válida.',
            'end_date.required' => 'La :attribute es obligatoria.',
            'end_date.date' => 'La :attribute no es válida.',
            'end_date.after_or_equal' => 'La :attribute debe ser igual o posterior a la :date.',
            'payment_id.exists' => 'El :attribute no es válido.',
        ];
    }
}

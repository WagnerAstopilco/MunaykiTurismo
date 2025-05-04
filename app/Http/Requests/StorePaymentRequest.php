<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'payment_method' => 'required|in:tarjeta_credito, tarjeta_debito, transferencia',
            'transaction_id' => 'nullable|string|min:4|max:12',
            'status' => 'required|string|in:pendiente,completada, fallida',
            'date' => 'nullable|date',
            'voucher' => 'nullable|string|max:255',
            'amount' => 'required|numeric|gte:0',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => 'usuario',
            'payment_method' => 'método de pago',
            'transaction_id' => 'ID de transacción',
            'status' => 'estado',
            'date' => 'fecha',
            'voucher' => 'comprobante',
            'amount' => 'monto',
        ];
    }
    public function messages()
    {
        return [
            'user_id.required' => 'El :attribute es obligatorio.',
            'user_id.exists' => 'El :attribute no es válido.',
            'payment_method.required' => 'El :attribute es obligatorio.',
            'payment_method.in' => 'El :attribute no es válido.',
            'transaction_id.min' => 'El :attribute debe tener al menos :min caracteres.',
            'transaction_id.max' => 'El :attribute no puede tener más de :max caracteres.',
            'status.required' => 'El :attribute es obligatorio.',
            'status.in' => 'El :attribute no es válido.',
            'date.required' => 'La :attribute es obligatoria.',
            'date.date' => 'La :attribute no es válida.',
            'voucher.max' => 'El :attribute no puede tener más de :max caracteres.',
            'amount.required' => 'El :attribute es obligatorio.',
            'amount.numeric' => 'El :attribute debe ser un número.',
            'amount.gte' => 'El :attribute debe ser mayor o igual a :value.',
        ];
    }
}

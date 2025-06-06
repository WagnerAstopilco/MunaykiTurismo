<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'names' => 'sometimes|required|string|min:5|max:255',
            'last_names' => 'sometimes|required|string|min:5|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,'.$this->user->id,
            'password' => 'sometimes|required|string|min:8|confirmed',
            'phone' => 'sometimes|nullable|string|max:15',
            'profile_photo' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'sometimes|required|in:cliente,administrador,agente',
            'status' => 'sometimes|required|in:activo,inactivo',
        ];
    }
    
    public function attributtes()
    {
        return [
            'names' => 'nombres',
            'last_names' => 'apellidos',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
            'phone' => 'teléfono',
            'profile_photo' => 'foto de perfil',
            'role' => 'rol',
            'status' => 'estado',
        ];
    }

    public function messages()
    {
        return [
            'names.required' => 'El campo :attribute es obligatorio.',
            'names.max' => 'El campo :attribute no debe tener más de :max caracteres.',
            'last_names.required' => 'El campo :attribute es obligatorio.',
            'last_names.max' => 'El campo :attribute no debe tener más de :max caracteres.',
            'email.required' => 'El campo :attribute es obligatorio.',
            'password.required' => 'El campo :attribute es obligatorio.',
            'profile_photo.image' => 'El campo :attribute debe ser una imagen.',
            'role.required' => 'El campo :attribute es obligatorio.',
            'status.required' => 'El campo :attribute es obligatorio.',
        ];
    }
}

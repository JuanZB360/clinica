<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:60',
            'email' => ['required','email',Rule::unique('users')->ignore($this->route('user'))],
            'password' => 'nullable|string|min:8|confirmed',
            'identity_card' => ['required','string','max:12',Rule::unique('users')->ignore($this->route('user'))],
            'birthday' => 'required|date',
            'speciality_id' => 'nullable|exists:specialities,id'
        ];
    }

    /**
     * Customize error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.max' => 'El nombre no debe ser mayor a 60 caracteres',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'email.required' => 'El email es requerido',
            'email.email' => 'Debe tener formato email example@example.com',
            'email.unique' => 'Este Correo ya esta registrado',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'identity_card.required' => 'El número de identificación es requerido',
            'identity_card.max' => 'El número de identificación no debe ser mayor a 12 caracteres',
            'identity_card.string' => 'El número de identificación debe ser una cadena de texto',
            'birthday.required' => 'La fecha de nacimiento es requerida',
            'birthday.date' => 'Debe tener formato de fecha dd/mm/yyyy',
            'speciality_id.exists' => 'La especialidad seleccionada no existe'
        ];
    }

}

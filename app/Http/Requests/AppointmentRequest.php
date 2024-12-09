<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'identity_card' => 'required|exists:users,identity_card',
            'reason' => 'required|string|max:255',
            'appointment_date' => 'required|date|after:now',
        ];
    }

     /**
     * Define mensajes de error personalizados (opcional).
     */
    public function messages(): array
    {
        return [
            'identity_card.required' => 'El número de identificación es obligatorio.',
            'identity_card.exists' => 'El número de identificación no existe en el sistema.',
            'reason.required' => 'El motivo de la cita es obligatorio.',
            'reason.string' => 'El motivo debe ser un texto.',
            'reason.max' => 'El motivo no puede superar los 255 caracteres.',
            'appointment_date.required' => 'La fecha y hora de la cita son obligatorias.',
            'appointment_date.date' => 'Debe proporcionar una fecha y hora válidas.',
            'appointment_date.after' => 'La fecha de la cita debe ser posterior al momento actual.',
        ];
    }
}

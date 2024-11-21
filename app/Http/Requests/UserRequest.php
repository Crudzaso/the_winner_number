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
        $user = $this->route('user');
        return [
            'name' => 'required|string|max:100',
            'phone_number' => ['required', 'string', 'max:15', Rule::unique('users')->ignore($this->route('user'))],
            'date_of_birth' => 'required|date|before:' . now()->subYears(18)->toDateString(),
            'identification_number' => ['required','string','max:20',Rule::unique('users')->ignore($this->route('user'))],
            'agreement_terms' => 'required|boolean',
            'accepted_privacy_policy' => 'required|boolean',
            'nequi_account' => ['required','string','max:15',Rule::unique('users')->ignore($this->route('user'))],
        ];
    }

    /**
     * Customize error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'phone_number.max' => 'El número de teléfono no debe exceder 15 caracteres.',
            'phone_number.required' => 'El numero de contacto es necesario',
            'phone_number.unique' => 'El numero de telefono ya esta registrado',
            'dete_of_birth.required' => 'La fecha de nacimiento es necesaria para confirmar tu edad',
            'date_of_birth.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'date_of_birth.before' => 'Debes tener 18 o me para poder registrarte.',
            'identification_number.required' => 'El número de identificación es obligatorio.',
            'identification_number.unique' => 'Este número de identificación ya está registrado.',
            'agreement_terms.required' => 'Debes aceptar los términos y condiciones.',
            'accepted_privacy_policy.required' => 'Debes aceptar la política de privacidad.',
            'nequi_account.required' => 'El numero de cuenta es requerido',
            'nequi_account.unique' => 'El numero de la cuenta nequi ya existe.'
        ];
    }
}

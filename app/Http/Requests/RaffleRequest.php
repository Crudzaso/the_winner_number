<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RaffleRequest extends FormRequest
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
            'name' => 'required|string',
            'price' => 'required|numeric',
            'award' => 'required|numeric',
            'start_date' => 'required|date',
            'closing_date' => 'required|date|after:start_date',
        ];
    }
    /**
     * Customize error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El nombre debe ser un texto.',
            
            'price.required' => 'El campo precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un valor numérico.',

            'award.required' => 'El campo premio es obligatorio.',
            'award.numeric' => 'El premio debe ser un valor numérico.',

            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',

            'closing_date.required' => 'La fecha de cierre es obligatoria.',
            'closing_date.date' => 'La fecha de cierre debe ser una fecha válida.',
            'closing_date.after' => 'La fecha de cierre debe ser posterior a la fecha de inicio.',
        ];
    }
}

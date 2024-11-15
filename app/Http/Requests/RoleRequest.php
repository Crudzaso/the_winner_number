<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleResquest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'permissions' => 'required'
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
            'permissions.required' => 'El permiso es requerido',
        ];
    }
}

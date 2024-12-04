<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleUpdateRequest extends FormRequest
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
            'name' => ['required',  Rule::unique('roles')->ignore($this->route('role'))],
            'permissions' => 'array|required',
        ];
    }

         /**
     * Customize error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del rol es requerido',
            'name.unique' => 'El nombre del rol ya esta registrado',
            'permission.required' => 'Debes seleccionar los permissios que asignaras al Rol',
        ];
    }
}

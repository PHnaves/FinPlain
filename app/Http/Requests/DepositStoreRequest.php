<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositStoreRequest extends FormRequest
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
            'deposit_value' => 'required|numeric|min:0.01',
        ];
    }

    public function messages()
    {
        return [
            'deposit_value.required' => 'O valor do depósito é obrigatório.',
            'deposit_value.numeric' => 'O valor do depósito deve ser numérico.',
            'deposit_value.min' => 'O depósito deve ser no mínimo R$ 0,01.',
        ];
    }
}

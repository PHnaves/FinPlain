<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'firstNameContact' => ['required','string','max:100'],
            'lastnameContact' => ['required','string','max:100'],
            'emailContact' => ['required','email','max:255'],
            'phoneContact' => ['required','string','max:20'],
            'messageContact' => ['required','string','max:500'],
        ];
    }

    public function messages() : array
    {
        return [
            'firstNameContact.required' => 'O campo nome é obrigatório.',
            'firstNameContact.string' => 'O campo nome deve ser um texto.',
            'firstNameContact.max' => 'O campo nome deve ter no máximo 100 caracteres.',

            'lastnameContact.required' => 'O campo sobrenome é obrigatório.',
            'lastnameContact.string' => 'O campo sobrenome deve ser um texto.',
            'lastnameContact.max' => 'O campo sobrenome deve ter no máximo 100 caracteres.',

            'emailContact.required' => 'O campo email é obrigatório.',
            'emailContact.emal' => 'O campo email deve ser um email.',
            'emailContact.max' => 'O campo email deve ter no máximo 255 caracteres.',

            'phoneContact.required' => 'O campo telefone é obrigatório.',
            'phoneContact.string' => 'O campo telefone deve ser digitado corretamente.',
            'phoneContact.max' => 'O campo telefone deve ter no máximo 20 caracteres.',

            'messageContact.required' => 'O campo mensagem é obrigatório.',
            'messageContact.string' => 'O campo mensagem deve ser um texto.',
            'messageContact.max' => 'O campo mensagem deve ter no máximo 500 caracteres.',
        ];
    }
}

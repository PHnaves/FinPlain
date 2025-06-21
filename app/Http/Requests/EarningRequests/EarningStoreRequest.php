<?php

namespace App\Http\Requests\EarningRequests;

use Illuminate\Foundation\Http\FormRequest;

class EarningStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:255'],
            'value' => ['required', 'numeric', 'min:1', 'max:99999999,99'],
            'recurrence' => ['required', 'in:unico,semanal,quinzenal,mensal,trimestral,semestral,anual'],
            'received_at' => ['required', 'date'],
        ];
    }

    public function messages() : array
    {
        return[
            'title.required' => 'O nome do ganho é obrigatório.',
            'title.max' => 'O nome do ganho deve ter no máximo 50 caracteres.',
            'description.max' => 'A descrição deve ter no maximo 255 caracteres.',
            'value.required' => 'O valor do ganho é obrigatório.',
            'value.numeric' => 'O valor deve ser um número.',
            'value.min' => 'O valor deve ser no minimo 1',
            'value.max' => 'O valor do ganho deve ser menor ou igual a 9999999,99.',
            'recurrence.required' => 'A recorrência é obrigatória.',
            'recurrence.in' => 'A recorrência selecionada é inválida.',
        ];
    }
}

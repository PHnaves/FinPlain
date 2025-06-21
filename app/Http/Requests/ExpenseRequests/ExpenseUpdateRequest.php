<?php

namespace App\Http\Requests\ExpenseRequests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseUpdateRequest extends FormRequest
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
            'expense_name' => ['required', 'string', 'max:100'],
            'expense_description' => ['required', 'string'],
            'expense_category' => ['required', 'string', 'max:100'],
            'expense_value' => ['required', 'numeric', 'min:1', 'max:99999999,99'],
            'recurrence' => ['required', 'in:a vista,semanal,quinzenal,mensal,trimestral,semestral,anual'],
            'installments' => ['nullable', 'integer', 'min:0'],
            'due_date' => ['required', 'date'],
            'payment_date' => ['nullable', 'date',]
        ];
    }

    public function messages(): array
    {
        return [
            'expense_name.required' => 'O nome da despesa é obrigatório.',
            'expense_name.max' => 'O nome da despesa deve ter no máximo 100 caracteres.',
            'expense_description.required' => 'A descrição é obrigatória.',
            'expense_category.required' => 'A categoria da despesa é obrigatória.',
            'expense_category.max' => 'A categoria da despesa deve ter no máximo 100 caracteres.',
            'expense_value.required' => 'O valor da despesa é obrigatório.',
            'expense_value.numeric' => 'O valor deve ser um número.',
            'expense_value.min' => 'O valor deve ser no mínimo 1.',
            'expense_value.max' => 'O valor deve ser no máximo 9999999,99.',
            'recurrence.required' => 'A recorrência é obrigatória.',
            'recurrence.in' => 'A recorrência selecionada é inválida.',
            'installments.integer' => 'O número de parcelas deve ser um número inteiro.',
            'installments.min' => 'O número mínimo de parcelas é 0.',
            'due_date.required' => 'A data de vencimento é obrigatória.',
            'due_date.date' => 'A data de vencimento deve ser uma data válida.',
            'payment_date.date' => 'A data de pagamentoda proxima parcela deve ser uma data válida.',
        ];
    }
}

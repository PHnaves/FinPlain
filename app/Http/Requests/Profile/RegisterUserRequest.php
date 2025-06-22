<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type_user' => ['required', 'string', 'in:conservador,moderado,arrojado'],
            'rent' => ['required', 'numeric', 'min:0', 'max:99999999,99'],
            'monthly_income' => ['required', 'numeric', 'min:0', 'max:99999999,99'],
            'payment_frequency' => ['required', 'string', 'in:mensal,quinzenal,semanal'],
            'payment_day' => ['required', 'numeric', 'between:1,31'],
            'terms' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return[
            'name.required' => 'O nome é obrigatório.',
            'name.string' => 'O nome deve ser um texto.',
            'name.max' => 'O nome deve ter no máximo 100 caracteres.',
    
            'email.required' => 'O email é obrigatório.',
            'email.string' => 'O email deve ser um texto.',
            'email.email' => 'O email deve ser válido.',
            'email.max' => 'O email deve ter no máximo 255 caracteres.',
            'email.unique' => 'O email já está em uso.',
    
            'password.required' => 'A senha é obrigatória.',
            'password.string' => 'A senha deve ser um texto.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'As senhas não conferem.',
    
            'type_user.required' => 'O tipo de usuário é obrigatório.',
            'type_user.string' => 'O tipo de usuário deve ser um texto.',
            'type_user.in' => 'O tipo de usuário deve ser conservador, moderado ou arrojado.',
    
            'rent.required' => 'A renta é obrigatório.',
            'rent.numeric' => 'A renta deve ser numérico.',
            'rent.min' => 'A renta deve ser maior ou igual a 0.',
            'rent.max' => 'A renta deve ser menor ou igual a 9999999,99.',
            
            'monthly_income.required' => 'O salario mensal é obrigatório.',
            'monthly_income.numeric' => 'O salario mensal deve ser numérico.',
            'monthly_income.min' => 'O salario mensal deve ser maior ou igual a 0.',
            'monthly_income.max' => 'O salario mensal deve ser menor ou igual a 99999999,99.',
            
            'payment_frequency.required' => 'A frequencia de pagamento é obrigatória.',
            'payment_frequency.string' => 'A frequencia de pagamento deve ser um texto.',
            'payment_frequency.in' => 'A frequencia de pagamento deve ser mensal, quinzenal ou semanal.',
            
            'payment_day.required' => 'O dia de pagamento é obrigatório.',
            'payment_day.numeric' => 'O dia de pagamento deve ser numérico.',
            'payment_day.between' => 'O dia de pagamento deve estar entre 1 e 31.',
            'terms.accepted' => 'Você deve aceitar os Termos de Serviço para se cadastrar.',
        ];
    }
}

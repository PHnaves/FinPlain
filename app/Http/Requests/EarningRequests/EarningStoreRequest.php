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
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'value' => 'required|numeric|min:0',
            'recurrence' => 'required|in:unico,semanal,quinzenal,mensal,trimestral,semestral,anual',
            'received_at' => 'required|date',
        ];
    }
}

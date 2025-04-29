<?php

namespace App\Http\Requests\GoalRequests;

use Illuminate\Foundation\Http\FormRequest;

class GoalShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $goal = $this->route('goal');
        return $goal && $goal->user_id === auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}

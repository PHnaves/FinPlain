<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'expense_name',
        'expense_description',
        'expense_category',
        'expense_value',
        'recurrence',
        'installments',
        'due_date',
        'payment_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

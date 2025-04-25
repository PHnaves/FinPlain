<?php

namespace App\Events;

use App\Models\Expense;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ExpenseLimit
{
    use Dispatchable, SerializesModels;

    public $user;
    public $expense;

    public function __construct(User $user, Expense $expense)
    {
        $this->user = $user;
        $this->expense = $expense;
    }
}

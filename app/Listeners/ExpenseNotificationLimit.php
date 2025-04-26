<?php

namespace App\Listeners;

use App\Events\ExpenseLimit;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;

class ExpenseNotificationLimit
{
    public function handle(ExpenseLimit $event)
    {
        $user = $event->user;
        $expense = $event->expense;
    
        // Evitar duplicação verificando antes de inserir
        $existsNotification = Notification::where('user_id', $user->id)
            ->where('message', "Atenção! Sua despesa '{$expense->expense_description}' ultrapassou 50% da sua renda!")
            ->exists();
    
        if (!$existsNotification && $expense->expense_value > ($user->rent * 0.5)) {
            Notification::create([
                'user_id' => $user->id,
                'message' => "Atenção! Sua despesa '{$expense->expense_description}' ultrapassou 50% da sua renda!",
            ]);
        }
    }
    
}

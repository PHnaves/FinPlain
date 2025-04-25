<?php

namespace App\Listeners;

use App\Events\ExpenseLimit;
use App\Models\Notificacao;
use Illuminate\Support\Facades\Mail;

class ExpenseNotificationLimit
{
    public function handle(ExpenseLimit $event)
    {
        $user = $event->user;
        $expense = $event->expense;
    
        // Evitar duplicação verificando antes de inserir
        $existsNotification = Notificacao::where('id_user', $user->id)
            ->where('mensagem', "Atenção! Sua despesa '{$expense->expense_description}' ultrapassou 50% da sua renda!")
            ->exists();
    
        if (!$existsNotification && $expense->expense_value > ($user->rent * 0.5)) {
            Notificacao::create([
                'id_user' => $user->id,
                'mensagem' => "Atenção! Sua despesa '{$expense->expense_description}' ultrapassou 50% da sua renda!",
            ]);
        }
    }
    
}

<?php

namespace App\Console\Commands;

use App\Models\Expense;
use App\Models\User;
use App\Notifications\ExpenseLimitValueNotification;
use Illuminate\Console\Command;
use Carbon\Carbon;

class ExpenseLimitValue extends Command
{
    protected $signature = 'despesas:limite';
    protected $description = 'Verifica despesas que ultrapassam o limite de 50% da renda do usuário.';

    public function handle()
    {
        $users = User::all(); // Buscar todos os usuários
        $notifiedExpenses = []; // Para armazenar as despesas já notificadas, para assim não precisar criar mais um campo no banco de dados

        foreach ($users as $user) {
            if ($user->rent) { // Garantir que tenha um valor de renda
                $limit = $user->rent * 0.5;

                $expenses = Expense::where('user_id', $user->id)->get();

                foreach ($expenses as $expense) {
                    if ($expense->expense_value > $limit && !in_array($expense->id, $notifiedExpenses)) {
                        // Envia a notificação
                        $user->notify(new ExpenseLimitValueNotification($expense));

                        // Marca a despesa como notificada no ciclo
                        $notifiedExpenses[] = $expense->id;
                    }
                }
            }
        }

        $this->info('Notificações de despesas com valor elevado enviadas com sucesso.');
    }
}

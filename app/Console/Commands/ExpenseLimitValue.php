<?php

namespace App\Console\Commands;

use App\Models\Expense;
use App\Models\User;
use App\Notifications\ExpenseLimitValueNotification;
use Illuminate\Console\Command;

class ExpenseLimitValue extends Command
{
    protected $signature = 'despesas:limite';
    protected $description = 'Verifica despesas que ultrapassam o limite de 50% da renda do usuário.';

    public function handle()
    {
        $users = User::all(); // Buscar todos os usuários

        foreach ($users as $user) {
            if ($user->rent) { // Garantir que tenha um valor de renda
                $limit = $user->rent * 0.5;

                $expenses = Expense::where('user_id', $user->id)->get();

                foreach ($expenses as $expense) {
                    if ($expense->expense_value > $limit) {
                        $user->notify(new ExpenseLimitValueNotification($expense));
                    }
                }
            }
        }

        $this->info('Notificações de despesas com valor elevado enviadas com sucesso.');
    }
}

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
        $users = User::all();
        $today = Carbon::today();

        foreach ($users as $user) {
            if ($user->rent) {
                $limit = $user->rent * 0.5;
                $this->info("Verificando usuário {$user->name} - Renda: R$ {$user->rent} - Limite: R$ {$limit}");

                // Busca todas as despesas do usuário
                $expenses = Expense::where('user_id', $user->id)->get();
                
                foreach ($expenses as $expense) {
                    $this->info("Verificando despesa: {$expense->expense_name} - Valor: R$ {$expense->expense_value}");
                    
                    // Verifica se a despesa já foi notificada hoje
                    $lastNotification = $user->notifications()
                        ->where('data->tipo', 'valor_limite_despesa')
                        ->where('data->expense_id', $expense->id)
                        ->whereDate('created_at', $today)
                        ->first();

                    if ($expense->expense_value > $limit && !$lastNotification) {
                        $this->info("Enviando notificação para despesa {$expense->expense_name}");
                        $user->notify(new ExpenseLimitValueNotification($expense));
                    }
                }
            } else {
                $this->info("Usuário {$user->name} não possui renda definida");
            }
        }

        $this->info('Verificação de despesas com valor elevado concluída.');
    }
}

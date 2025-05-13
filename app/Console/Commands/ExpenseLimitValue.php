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

                // Busca todas as despesas do usuário criadas após a última atualização do salário
                $expenses = Expense::where('user_id', $user->id)
                    ->where('created_at', '>=', $user->updated_at)
                    ->whereNull('payment_date') // Apenas despesas não pagas
                    ->get();
                
                foreach ($expenses as $expense) {
                    $this->info("Verificando despesa: {$expense->expense_name} - Valor: R$ {$expense->expense_value}");
                    
                    // Verifica se a despesa já foi notificada nos últimos 7 dias
                    $lastNotification = $user->notifications()
                        ->where('data->tipo', 'valor_limite_despesa')
                        ->where('data->expense_id', $expense->id)
                        ->where('created_at', '>=', now()->subDays(7))
                        ->first();

                    // Se a despesa teve o valor maior que o limite e não foi notificada nos últimos 7 dias, envia a notificação
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

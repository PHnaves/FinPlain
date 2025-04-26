<?php

namespace App\Console\Commands;

use App\Models\Goal;
use App\Models\User;
use App\Notifications\TargetDepositNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TargetDeposit extends Command
{
    protected $signature = 'notificar:depositos';
    protected $description = 'Notificar usuários sobre depósitos de metas conforme frequência.';

    public function handle()
    {
        $today = Carbon::today();
        $goals = Goal::where('status', 'andamento')->get(); // Só metas em andamento

        foreach ($goals as $goal) {
            $createdAt = Carbon::parse($goal->created_at);

            if ($goal->frequency === 'semanal') {
                // A cada 7 dias a partir da criação
                $diffInDays = $createdAt->diffInDays($today);

                if ($diffInDays % 7 == 0) { // Se passou múltiplos de 7 dias
                    $this->notifyUser($goal);
                }
            }

            if ($goal->frequency === 'mensal') {
                // A cada 1 mês a partir da criação
                $diffInMonths = $createdAt->diffInMonths($today);

                if ($createdAt->addMonths($diffInMonths)->isSameDay($today)) {
                    $this->notifyUser($goal);
                }
            }
        }

        $this->info('Notificações de depósitos de metas enviadas com sucesso.');
    }

    private function notifyUser($goal)
    {
        $user = User::find($goal->user_id);
        if ($user) {
            $user->notify(new TargetDepositNotification($goal));
        }
    }
}


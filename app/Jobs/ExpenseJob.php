<?php

namespace App\Jobs;

use App\Models\Expense;
use App\Models\User;
use App\Mail\ExpenseEmail;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ExpenseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {}

    public function handle()
    {
        $tomorrow = Carbon::tomorrow();

        // Buscar todas as despesas ativas
        $expenses = Expense::all();

        foreach ($expenses as $expense) {
            $user = User::find($expense->user_id);

            if (!$user) {
                continue;
            }

            // Se for "a vista", verifica só a primeira data de vencimento
            if ($expense->recurrence == 'a vista') {
                if (Carbon::parse($expense->due_date)->isSameDay($tomorrow)) {
                    Mail::to($user->email)->send(new ExpenseEmail($user, $expense));
                }
            } else {
                // Calcular a próxima data baseada na recorrência
                $nextDueDate = Carbon::parse($expense->due_date);

                $installmentCount = 1;

                while ($installmentCount <= $expense->installments) {
                    // Verifica se amanhã é o vencimento da parcela atual
                    if ($nextDueDate->isSameDay($tomorrow)) {
                        Mail::to($user->email)->send(new ExpenseEmail($user, $expense));
                        break; // já enviou o e-mail para esta despesa
                    }

                    // Incrementa a próxima data baseada na recorrência
                    switch ($expense->recurrence) {
                        case 'semanal':
                            $nextDueDate->addWeek();
                            break;
                        case 'quinzenal':
                            $nextDueDate->addWeeks(2);
                            break;
                        case 'mensal':
                            $nextDueDate->addMonth();
                            break;
                        case 'trimestral':
                            $nextDueDate->addMonths(3);
                            break;
                        case 'semestral':
                            $nextDueDate->addMonths(6);
                            break;
                        case 'anual':
                            $nextDueDate->addYear();
                            break;
                    }

                    $installmentCount++;
                }
            }
        }
    }
}

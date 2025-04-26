<?php

namespace App\Console\Commands;

use App\Models\Expense;
use App\Models\User;
use App\Notifications\OverdueExpenseNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class OverdueExpense extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notificar:despesas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow();
    
        $expenses = Expense::whereDate('due_date', $tomorrow)->get();
    
        foreach ($expenses as $expense) {
            $user = User::find($expense->user_id);
            if ($user) {
                $user->notify(new OverdueExpenseNotification($expense));
            }
        }
    
        $this->info('Notificações de despesas vencendo enviadas com sucesso.');
    }
}

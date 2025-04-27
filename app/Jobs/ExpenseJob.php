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

    // Construtor vazio, já que não estamos passando parâmetros para o Job
    public function __construct() {
        
    }

    public function handle()
    {
        $tomorrow = Carbon::tomorrow();
        $expenses = Expense::whereDate('due_date', $tomorrow)->get();
    
        foreach ($expenses as $expense) {
            $user = User::find($expense->user_id);
            if ($user) {
                Mail::to($user->email)->send(new ExpenseEmail($user, $expense));
            }
        }
    }
}

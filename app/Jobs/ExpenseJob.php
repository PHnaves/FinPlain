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
use Illuminate\Support\Facades\Log;

class ExpenseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Construtor vazio, já que não estamos passando parâmetros para o Job
    public function __construct() {}

    public function handle()
    {
        try {
            // Obter a data de amanhã
            $tomorrow = Carbon::tomorrow();

            // Buscar todas as despesas que vencem amanhã
            $expenses = Expense::whereDate('due_date', $tomorrow)->get();

            // Enviar o e-mail para cada usuário com a sua despesa correspondente
            foreach ($expenses as $expense) {
                $user = User::find($expense->user_id); // Buscar o usuário relacionado à despesa

                // Verificar se o usuário existe antes de tentar enviar o e-mail
                if ($user) {
                    // Enviar o e-mail usando o Job ExpenseEmail
                    Mail::to($user->email)->send(new ExpenseEmail($user, $expense));
                    Log::info("E-mail de despesa enviado para: {$user->email} para a despesa: {$expense->expense_name}");
                } else {
                    // Caso o usuário não seja encontrado, registrar o erro no log
                    Log::error("Usuário não encontrado para a despesa: {$expense->expense_name}");
                }
            }

        } catch (\Exception $e) {
            // Capturar e registrar qualquer erro que ocorrer no processo
            Log::error("Erro ao enviar e-mails de despesas: " . $e->getMessage());
        }
    }
}

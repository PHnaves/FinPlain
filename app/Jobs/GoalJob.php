<?php

namespace App\Jobs;

use App\Models\Goal;
use App\Models\User;
use App\Mail\GoalEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class GoalJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {}

    public function handle()
    {
        try {
            // Obtém a data atual
            $today = Carbon::now();

            // Busca todas as metas que precisam de um lembrete
            $goals = Goal::where('status', 'andamento')
                ->where(function ($query) use ($today) {
                    $query->where(function ($q) use ($today) {
                        // Enviar se a periodicidade for semanal e o dia da criação coincidir com o dia da semana atual
                        $q->where('periodicidade', 'semanal')
                          ->whereRaw('WEEKDAY(created_at) = ?', [$today->dayOfWeek]);
                    })->orWhere(function ($q) use ($today) {
                        // Enviar se a periodicidade for mensal e o dia da criação coincidir com o dia do mês atual
                        $q->where('periodicidade', 'mensal')
                          ->whereRaw('DAY(created_at) = ?', [$today->day]);
                    });
                })
                ->get();

            // Envia o e-mail para cada usuário com a meta correspondente
            foreach ($goals as $goal) {
                $user = User::find($goal->user_id);

                // Verifica se o usuário existe
                if ($user) {
                    try {
                        // Envia o e-mail de meta
                        Mail::to($user->email)->send(new GoalEmail($user, $goal));
                        Log::info("E-mail de meta enviado para: {$user->email} para a meta: {$goal->goal_name}");
                    } catch (\Exception $e) {
                        // Caso haja erro ao enviar o e-mail, registra no log
                        Log::error("Erro ao enviar e-mail para o usuário {$user->email}: " . $e->getMessage());
                    }
                } else {
                    // Caso o usuário não seja encontrado, registra no log
                    Log::error("Usuário não encontrado para a meta: {$goal->goal_name}");
                }
            }

        } catch (\Exception $e) {
            // Captura qualquer erro que ocorra ao processar o Job
            Log::error("Erro ao processar o GoalJob: " . $e->getMessage());
        }
    }
}

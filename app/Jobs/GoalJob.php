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
        $today = Carbon::today();
        $goals = Goal::where('status', 'andamento')->get(); // Metas em andamento

        foreach ($goals as $goal) {
            $createdAt = Carbon::parse($goal->created_at);

            if ($goal->frequency === 'semanal') {
                $diffInDays = $createdAt->diffInDays($today);

                if ($diffInDays % 7 == 0) { // Múltiplos de 7 dias
                    $this->sendGoalEmail($goal);
                }
            }

            if ($goal->frequency === 'mensal') {
                $diffInMonths = $createdAt->diffInMonths($today);

                if ($createdAt->addMonths($diffInMonths)->isSameDay($today)) {
                    $this->sendGoalEmail($goal);
                }
            }
        }
    }

    private function sendGoalEmail($goal)
    {
        $user = User::find($goal->user_id);

        if ($user) {
            Mail::to($user->email)->send(new GoalEmail($user, $goal));
            Log::info("E-mail de meta enviado para: {$user->email} para a meta: {$goal->goal_name}");
        } else {
            Log::error("Usuário não encontrado para a meta: {$goal->goal_name}");
        }
    }
}

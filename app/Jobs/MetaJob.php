<?php

namespace App\Jobs;

use App\Models\Meta;
use App\Models\User;
use App\Mail\EmailMeta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class MetaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {}

    public function handle()
    {
        // Obtém a data atual
        $hoje = Carbon::now();

        // Busca todas as metas que precisam de um lembrete hoje
        $metas = Meta::where('status', 'andamento')
            ->where(function ($query) use ($hoje) {
                $query->where(function ($q) use ($hoje) {
                    // Enviar se a periodicidade for semanal e hoje for o mesmo dia da semana da criação
                    $q->where('periodicidade', 'semanal')
                      ->whereRaw('WEEKDAY(created_at) = ?', [$hoje->dayOfWeek]);
                })->orWhere(function ($q) use ($hoje) {
                    // Enviar se a periodicidade for mensal e hoje for o mesmo dia do mês da criação
                    $q->where('periodicidade', 'mensal')
                      ->whereRaw('DAY(created_at) = ?', [$hoje->day]);
                });
            })
            ->get();

        // Envia o email para cada usuário com a meta correspondente
        foreach ($metas as $meta) {
            $user = User::find($meta->id_user);
            if ($user) {
                Mail::to($user->email)->send(new EmailMeta($user, $meta));
            }
        }
    }
}

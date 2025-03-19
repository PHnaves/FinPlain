<?php

namespace App\Jobs;

use App\Models\Meta;
use App\Models\User;
use App\Mail\EmailMeta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnviarEmailDepositoMeta implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {}

    public function handle()
    {
        // Buscar metas com depósito semanal ou mensal
        $metas = Meta::where(function ($query) {
            $query->where('frequencia', 'semanal')->whereDay('updated_at', now()->dayOfWeek)
                  ->orWhere('frequencia', 'mensal')->whereDay('updated_at', now()->day);
        })->get();

        foreach ($metas as $meta) {
            $user = User::find($meta->id_user);
            Mail::to($user->email)->send(new EmailMeta($user, $meta));
        }
    }
}


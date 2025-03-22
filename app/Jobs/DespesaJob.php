<?php
namespace App\Jobs;

use App\Models\Despesa;
use App\Models\User;
use App\Mail\EmailVencimento;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class DespesaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {}

    public function handle()
    {

        // obtem a data de amanha
        $amanha = Carbon::tomorrow();

        // busca todas as despesas que vencem amanha
        $despesas = Despesa::whereDate('data_vencimento' === $amanha)->get();

        // envia o email para cada usuario com a sua despesa correspondente
        foreach ($despesas as $despesa) {
            $user = User::find($despesa->id_user);
            if ($user) {
                Mail::to($user->email)->send(new EmailVencimento($user, $despesa));
            }
        }

    }
}


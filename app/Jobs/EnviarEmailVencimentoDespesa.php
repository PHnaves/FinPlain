<?php
namespace App\Jobs;

use App\Models\Despesa;
use App\Models\User;
use App\Mail\EmailVencimento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnviarEmailVencimentoDespesa implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {}

    public function handle()
    {
        // Buscar despesas que vencem hoje
        $despesas = Despesa::whereDate('data_vencimento', today())->get();

        foreach ($despesas as $despesa) {
            $user = User::find($despesa->id_user);
            Mail::to($user->email)->send(new EmailVencimento($user, $despesa));
        }
    }
}


<?php

namespace App\Listeners;

use App\Events\GastoExcedido;
use App\Models\Notificacao;
use Illuminate\Support\Facades\Mail;

class EnviarNotificacaoGastoExcedido
{
    public function handle(GastoExcedido $event)
    {
        $user = $event->user;
        $gasto = $event->gasto;
    
        // Evitar duplicação verificando antes de inserir
        $existeNotificacao = Notificacao::where('id_user', $user->id)
            ->where('mensagem', "Atenção! Sua despesa '{$gasto->descricao}' ultrapassou 50% da sua renda!")
            ->exists();
    
        if (!$existeNotificacao && $gasto->necessario == 'nao') {
            Notificacao::create([
                'id_user' => $user->id,
                'mensagem' => "Atenção! Sua despesa '{$gasto->descricao}' ultrapassou 50% da sua renda!",
            ]);
        }
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacao;
use Illuminate\Support\Facades\Auth;

class NotificacaoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notificacoes = $user->notificacoes()->orderBy('created_at', 'desc')->get();
    
        return view('notificacoes', compact('notificacoes'));
    }

    public function marcarComoLida($id)
    {
        $notificacao = Notificacao::find($id);
        if ($notificacao->id_user === Auth::id()) {
            $notificacao->update(['lida' => true]);
        }
        return redirect()->route('notificacoes');
    }

    public function destroy(Notificacao $notificacao){
        // verifica se a notificacao foi lida
        if ($notificacao->lida){
            $notificacao->delete();
            return redirect()->route('notificacoes');
        }

        return route('notificacoes');

    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacao;
use Illuminate\Support\Facades\Auth;

class NotificacaoController extends Controller
{
    public function index()
    {
        $notificacoes = Auth::user()->notificacoes()->orderBy('created_at', 'desc')->get();
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
}


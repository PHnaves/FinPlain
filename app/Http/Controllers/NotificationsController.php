<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use App\Notifications\OverdueExpenseNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $tipo = $request->input('tipo');

        $notificacoes = $user->notifications()
            ->when($tipo, function ($query, $tipo) {
                return $query->where('data->tipo', $tipo);
            })
            ->latest()
            ->paginate(10);

        return view('notificacoes', compact('notificacoes'));
    }

    public function marcarComoLida($id)
    {
        $notificacao = Auth::user()->notifications()->findOrFail($id);
        $notificacao->markAsRead();

        return redirect()->back()->with('success', 'Notificação marcada como lida!');
    }

    public function excluir($id)
    {
        $notificacao = Auth::user()->notifications()->findOrFail($id);
        $notificacao->delete();

        return redirect()->back()->with('success', 'Notificação excluída com sucesso!');
    }
}


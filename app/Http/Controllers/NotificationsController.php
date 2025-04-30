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
        $type = $request->input('type');

        // Filtra as notificação por tipo
        $notifications = $user->notifications()
            ->when($type, function ($query, $type) {
                return $query->where('data->type', $type);
            })
            ->latest()
            ->paginate(10);

        return view('notificacoes', compact('notifications'));
    }

    public function markAsRead($id)
    {
        // Marca a notificação como lida
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect()->back()->with('success', 'Notificação marcada como lida!');
    }

    public function destroy($id)
    {
        // Exclui a notificação
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Notificação excluída com sucesso!');
    }
}


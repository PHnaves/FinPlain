<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->orderBy('created_at', 'desc')->get();
    
        return view('notificacoes', compact('notifications'));
    }

    public function marcarComoLida($id)
    {
        $notification = Notification::find($id);
        if ($notification->user_id === Auth::id()) {
            $notification->update(['status' => 'read']);
        }
        return redirect()->route('notificacoes');
    }

    public function destroy(Notification $notification){
        // verifica se a notificacao foi lida
        if ($notification->status === 'read') {
            $notification->delete();
            return redirect()->route('notificacoes');
        }

        return route('notificacoes');

    }
}


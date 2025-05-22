<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TargetDepositNotification extends Notification
{
    use Queueable;

    protected $goal;
    /**
     * Create a new notification instance.
     */
    public function __construct($goal)
    {
        $this->goal = $goal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'tipo' => 'deposito_meta',
            'goal_id' => $this->goal->id,
            'mensagem' => "Hoje é o dia agendado para contribuir com sua meta \"{$this->goal->goal_title}\". O valor do depósito previsto é de R$ " . number_format($this->goal->goal_current_value, 2, ',', '.') . ". Continue firme!"];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

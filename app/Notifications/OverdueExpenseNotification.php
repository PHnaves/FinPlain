<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OverdueExpenseNotification extends Notification
{
    use Queueable;

    protected $expense;
    /**
     * Create a new notification instance.
     */
    public function __construct($expense)
    {
        $this->expense = $expense;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'tipo' => 'despesa_vencida',
            'expense_id' => $this->expense->id,
            'mensagem' => "Olá! Só passando pra lembrar que a despesa \"{$this->expense->expense_name}\" de R$ " . number_format($this->expense->expense_value, 2, ',', '.') . " vence amanhã. Fique atento!",
        ];
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

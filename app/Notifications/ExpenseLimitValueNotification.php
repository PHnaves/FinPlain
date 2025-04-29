<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExpenseLimitValueNotification extends Notification
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
            'tipo' => 'valor_limite_despesa',
            'expense_id' => $this->expense->id,
            'mensagem' => "Atenção! A despesa '{$this->expense->expense_name}' no valor de R$ {$this->expense->expense_value} ultrapassou 50% de sua renda mensal. Considere revisar seus gastos."
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

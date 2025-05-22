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
        $limit = $notifiable->rent * 0.5;
        $percentage = round(($this->expense->expense_value / $notifiable->rent) * 100, 1);
        
        return [
            'tipo' => 'valor_limite_despesa',
            'expense_id' => $this->expense->id,
            'mensagem' => "Atenção! Uma parcela da sua despesa '{$this->expense->expense_name}' no valor de R$ " . number_format($this->expense->expense_value, 2, ',', '.') . 
                         " representa {$percentage}% de sua renda mensal (R$ " . number_format($notifiable->rent, 2, ',', '.') . "). " .
                         "O limite recomendado é de 50% (R$ " . number_format($limit, 2, ',', '.') . "). " .
                         "Considere revisar seus gastos ou ajustar seu orçamento."
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

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class EmailVencimento extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $despesa;

    public function __construct($user, $despesa)
    {
        $this->user = $user;
        $this->despesa = $despesa;
    }

    public function build()
    {
        return $this->subject('🔔 Lembrete: Despesa Vencendo!')
                    ->markdown('emails.vencimento');
    }
}

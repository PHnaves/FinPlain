<?php

namespace App\Mail;

use App\Models\Despesa;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VencimentoDespesaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $despesa;

    public function __construct(Despesa $despesa)
    {
        $this->despesa = $despesa;
    }

    public function build()
    {
        return $this->subject("🚨 Sua despesa está vencendo!")
                    ->markdown('emails.vencimento_despesa')
                    ->with(['despesa' => $this->despesa]);
    }
}

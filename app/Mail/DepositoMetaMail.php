<?php

namespace App\Mail;

use App\Models\Meta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DepositoMetaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $meta;

    public function __construct(Meta $meta)
    {
        $this->meta = $meta;
    }

    public function build()
    {
        return $this->subject("💰 Lembrete de Depósito para sua Meta!")
                    ->markdown('emails.deposito_meta')
                    ->with(['meta' => $this->meta]);
    }
}

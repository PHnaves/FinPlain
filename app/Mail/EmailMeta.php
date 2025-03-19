<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class EmailMeta extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $meta;

    public function __construct($user, $meta)
    {
        $this->user = $user;
        $this->meta = $meta;
    }

    public function build()
    {
        return $this->subject('💰 Lembrete: Depósito para Meta')
                    ->markdown('emails.meta');
    }
}


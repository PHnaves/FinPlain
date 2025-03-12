<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Gasto;
use App\Models\User;

class GastoExcedido
{
    use Dispatchable, SerializesModels;

    public $user;
    public $gasto;

    public function __construct(User $user, Gasto $gasto)
    {
        $this->user = $user;
        $this->gasto = $gasto;
    }
}

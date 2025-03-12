<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\GastoExcedido;
use App\Listeners\EnviarNotificacaoGastoExcedido;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        GastoExcedido::class => [
            EnviarNotificacaoGastoExcedido::class,
        ],
    ];
    

    public function boot()
    {
        parent::boot();
    }
}


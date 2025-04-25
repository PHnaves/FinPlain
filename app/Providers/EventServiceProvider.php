<?php

namespace App\Providers;

use App\Events\ExpenseLimit;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\ExpenseNotificationLimit;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ExpenseLimit::class => [
            ExpenseNotificationLimit::class,
        ],
    ];
    

    public function boot()
    {
        parent::boot();
    }
}


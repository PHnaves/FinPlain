<?php

use App\Jobs\EnviarEmailDepositoMeta;
use App\Jobs\EnviarEmailVencimentoDespesa;
use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule; // Importação correta

// Agendamento correto no Laravel 11
Schedule::call(fn () => dispatch(new EnviarEmailVencimentoDespesa()))->dailyAt('08:00');
Schedule::call(fn () => dispatch(new EnviarEmailDepositoMeta()))->everyMinute(); // Teste

// Comando Artisan padrão
Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

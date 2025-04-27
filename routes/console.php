<?php

use App\Jobs\ExpenseJob;
use App\Jobs\GoalJob;
use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule; // Importação correta

// Agendando os comandos de notificações
Schedule::command('notificar:despesas')->dailyAt('06:00');
Schedule::command('notificar:depositos')->dailyAt('06:00');
Schedule::command('despesas:limite')->dailyAt('06:00');

// Agendando os Jobs corretamente para envio de e-mails
Schedule::job(new GoalJob)->dailyAt('06:00'); // Agendando o GoalJob
Schedule::job(new ExpenseJob)->dailyAt('06:00'); // Agendando o ExpenseJob

// Comando Artisan padrão
Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

<?php

use App\Jobs\ExpenseJob;
use App\Jobs\GoalJob;
use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule; // Importação correta

// Agendando os Jobs corretamente para envio de e-mails
Schedule::job(new GoalJob())->dailyAt('11:00'); // Agendando o GoalJob
Schedule::job(new ExpenseJob())->dailyAt('11:00'); // Agendando o ExpenseJob

// Comando Artisan padrão
Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

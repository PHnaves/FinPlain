<?php

use App\Jobs\MetaJob;
use App\Jobs\DespesaJob;
use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule; // Importação correta

// Agendando Jobs corretamente
Schedule::job(new MetaJob())->dailyAt('11:00');
Schedule::job(new DespesaJob())->dailyAt('11:00');


// Comando Artisan padrão
Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

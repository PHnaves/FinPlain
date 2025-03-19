<?php

namespace App\Jobs;

use App\Mail\VencimentoDespesaMail;
use App\Models\Despesa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnviarEmailVencimentoDespesa implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $despesa;

    public function __construct(Despesa $despesa)
    {
        $this->despesa = $despesa;
    }

    public function handle()
    {
        Mail::to($this->despesa->user->email)->send(new VencimentoDespesaMail($this->despesa));
    }
}

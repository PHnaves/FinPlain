<?php

namespace App\Jobs;

use App\Mail\DepositoMetaMail;
use App\Models\Meta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnviarEmailDepositoMeta implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $meta;

    public function __construct(Meta $meta)
    {
        $this->meta = $meta;
    }

    public function handle()
    {
        Mail::to($this->meta->user->email)->send(new DepositoMetaMail($this->meta));
    }
}

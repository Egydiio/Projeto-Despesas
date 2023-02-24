<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Despesas;
use App\Mail\Email;
use App\Models\User;

class sendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user;
    public $despesas;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user,Despesas $despesas)
    {
        $this->user = $user;
        $this->despesas = $despesas;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::queue((new Email($this->user,$this->despesas))
        ->from('only@gmail.com', 'emailOnly')
        ->to('egydiio@hotmail.com', 'joao')
        );
    }
}

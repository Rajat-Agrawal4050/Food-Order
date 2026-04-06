<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $msg,$sub;
    /**
     * Create a new job instance.
     */
    public function __construct($message,  $subject)
    {
        //
        $this->msg=$message;
        $this->sub=$subject;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $to_mail = "rajatagrawal9394@gmail.com"; 
        Mail::to($to_mail)->send(new WelcomeMail($this->msg, $this->sub));
    }
}

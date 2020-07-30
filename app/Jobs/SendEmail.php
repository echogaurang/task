<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendMail;
use Illuminate\Mail\Mailable;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
   public function __construct(User $user, Mailable $mail)
    {
       $this->details = $details;

    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendMail($this->details);
        Mail::to($this->details['email'])->send($email);
    }
}

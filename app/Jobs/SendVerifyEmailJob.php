<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendVerifyEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    public $password;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, string $password)
    {
        $this->user = $user;

        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [
            'email' => ($this->user)->email,
            'password' => $this->password,
            'token' => ($this->user)->token
        ];

        Mail::send('mail.confirm', $data, function ($message) {
            $message->from(env('MAIL_FROM_ADDRESS'), 'RMIT Club Management System');
            $message->to(($this->user)->email, ($this->user)->name);
            $message->subject('Please verify your email');
        });
    }
}

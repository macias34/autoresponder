<?php

namespace App\Console\Commands;

use App\Models\Email;
use App\Services\MailService;
use Illuminate\Console\Command;

class AnswerEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:answer-emails';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

//    public function __construct(protected EmailResponseService $emailResponseService)
//    {
//    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $emails = Email::all()->where('answered', false)->where('user.auto_answered', true);
        $emails->each(function ($email) {
            $smtpConfiguration = $email->user->smtpConfiguration;
            $mailService = new MailService($smtpConfiguration);
            $mailService->send($email);
        });
    }
}

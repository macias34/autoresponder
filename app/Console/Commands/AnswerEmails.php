<?php

namespace App\Console\Commands;

use App\Actions\CreateEmailResponse;
use App\Models\Email;
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

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $emails = Email::all()->whereNull('response');

        $emails->each(function ($email) {
            CreateEmailResponse::run($email);
        });
    }
}

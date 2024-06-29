<?php

namespace App\Console\Commands;

use App\Models\Email;
use App\Services\EmailResponseService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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

    public function __construct(protected EmailResponseService $emailResponseService)
    {
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $emails = Email::all()->whereNull('response')->where('user.auto_generated', true);
        Log::debug($emails->toArray());
//        $emails->each(function ($email) {
//            $this->emailResponseService->createAndSaveResponse($email);
//        });
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Email;
use App\Services\EmailResponseService;
use Illuminate\Console\Command;

class GenerateEmailResponses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-email-responses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(EmailResponseService $emailResponseService)
    {
        $emails = Email::all()->whereNull('response')->where('user.auto_generated', true);
        $emails->each(function ($email) use ($emailResponseService) {
            $emailResponseService->createAndSaveResponse($email);
        });
    }
}

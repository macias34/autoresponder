<?php

namespace App\Console\Commands;

use App\Mappers\EmailMapper;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Webklex\PHPIMAP\ClientManager;

class PollImapEmails extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:poll-imap-emails';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * Execute the console command.
     */
    public function handle(EmailMapper $emailMapper): void
    {
        User::all()->each(function ($user) use ($emailMapper) {
            $cm = new ClientManager($options = []);

            $imapConfiguration = $user->imapConfiguration->toArray();

            try {
                $client = $cm->make([
                    ...$imapConfiguration,
                    'default_config' => 'default'
                ]);

                $client->connect();
                $folder = $client->getFolder('INBOX');
                $messages = $folder->messages()->all()->get()->toArray();

                $client->disconnect();

                Log::debug('Polling Imap emails..');

                $emails = array_map(fn($message) => $emailMapper->mapMessageToEmail($message)->toArray(), $messages);
                $user->emails()->createMany($emails);

            } catch (\Exception $e) {
                Log::debug("Failed to polled imap emails.");
            }
        });
    }
}


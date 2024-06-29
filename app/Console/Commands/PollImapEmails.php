<?php

namespace App\Console\Commands;

use App\Models\Email;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Webklex\PHPIMAP\ClientManager;
use Webklex\PHPIMAP\Support\MessageCollection;

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
    public function handle()
    {
        User::all()->each(function ($user) {
            $cm = new ClientManager($options = []);

            $imapConfiguration = $user->imapConfiguration->toArray();

            try {
                $client = $cm->make([
                    ...$imapConfiguration,
                    'default_config' => 'default'
                ]);

                $client->connect();
                $folder = $client->getFolder('INBOX');
                $messages = $folder->messages()->all()->get();

                $client->disconnect();

                Log::debug('Polling Imap emails..');

                $emails = $this->mapMessagesToEmailModel($messages);

                $user->emails()->createMany($emails);

            } catch (\Exception $e) {
                Log::debug("Failed to polled imap emails.");
            }
        });

    }

    protected function mapMessagesToEmailModel(MessageCollection $messages): array
    {
        return collect($messages)->map(function ($message) {
            return new Email([
                'id' => $message->getUid(),
                'subject' => $message->getSubject(),
                'text' => $message->getTextBody(),
                'html' => $message->getHtmlBody(),
            ]);
        })->toArray();
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Email;
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
        $cm = new ClientManager($options = []);

        $client = $cm->make([
            'host' => "imap.gmail.com",
            'port' => 993,
            'encryption' => "ssl",
            'validate_cert' => true,
            'username' => "imapmaciej@gmail.com",
            'password' => "dzop tmso nzaf cpch",
            'default_config' => 'default'
        ]);
        $client->connect();
        $folder = $client->getFolder('INBOX');
        $messages = $folder->messages()->all()->get();

        $client->disconnect();

        Log::debug('Polling Imap emails..');

        $emails = $this->mapMessagesToEmailModel($messages);

        $existingEmailIds = Email::whereIn('id', array_column($emails, 'id'))->pluck('id')->toArray();

        $newEmails = array_filter($emails, function ($email) use ($existingEmailIds) {
            return !in_array($email['id'], $existingEmailIds);
        });

        if (!empty($newEmails)) {
            Email::insert($newEmails);
        }
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

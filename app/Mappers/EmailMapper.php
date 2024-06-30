<?php

namespace App\Mappers;

use App\Models\Email;
use Webklex\PHPIMAP\Message;

class EmailMapper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function mapMessageToEmail(Message $message): Email
    {
        $from = $message->getFrom();
        $email = $from[0]->mail;
        $personal = $from[0]->personal;
        return new Email([
            'id' => $message->getUid(),
            'subject' => $message->getSubject(),
            'text' => $message->getTextBody(),
            'html' => $message->getHtmlBody(),
            'from' => $email,
            'personal' => $personal,
        ]);
    }
}

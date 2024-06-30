<?php

namespace App\Services;

use App\Mail\ResponseEmail;
use App\Models\Email;
use App\Models\SmtpConfiguration;
use Illuminate\Mail\Mailer;
use Symfony\Component\Mailer\Transport\Dsn;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransportFactory;

class MailService
{
    private $mailer;

    public function __construct(SmtpConfiguration $smtpConfiguration)
    {

        $factory = new EsmtpTransportFactory();
        $transport = $factory->create(new Dsn(
            scheme: 'tls',
            host: $smtpConfiguration->host,
            user: $smtpConfiguration->user,
            password: $smtpConfiguration->password,
            port: $smtpConfiguration->port
        ));

        $view = app()->get('view');
        $events = app()->get('events');

        $this->mailer = new Mailer
        (
            "mailer",
            $view,
            $transport,
            $events
        );
    }

    public function send(Email $email, string $address, string $name): void
    {
        $mailable = new ResponseEmail($email);

        $this->mailer->alwaysFrom(address: $address, name: $name);
        $this->mailer->to($email->from)->send($mailable);

        $email->update([
            'answered' => true
        ]);
    }
}

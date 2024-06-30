<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $user->imapConfiguration()->create(
            [
                'host' => 'imap.gmail.com',
                'port' => 993,
                'encryption' => 'ssl',
                'username' => 'username',
                'password' => 'password',
                'validate_cert' => true,
            ]
        );

        $user->smtpConfiguration()->create([
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'user' => 'user',
            'password' => 'password',
        ]);
    }

}

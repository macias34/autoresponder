<?php

use App\Jobs\AnswerEmails;
use Illuminate\Support\Facades\Schedule;

Schedule::command('app:poll-imap-emails')
    ->everyFifteenSeconds()
    ->withoutOverlapping()
    ->runInBackground();

Schedule::command('app:generate-email-responses')
    ->everyFifteenSeconds()
    ->withoutOverlapping()
    ->runInBackground();

Schedule::command('app:answer-emails')
    ->everyFifteenSeconds()
    ->withoutOverlapping()
    ->runInBackground();

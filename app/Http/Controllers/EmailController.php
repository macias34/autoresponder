<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Services\EmailResponseService;
use App\Services\MailService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EmailController extends Controller
{
    public function __construct(protected EmailResponseService $emailResponseService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $emails = Email::latest()->get();
        return view('emails.index', ['emails' => $emails]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Email $email): View
    {

        return view('emails.show', ['email' => $email]);
    }

    public function generateResponse(Email $email): RedirectResponse
    {
        $this->emailResponseService->createAndSaveResponse($email);
        return to_route('emails.show', ['email' => $email]);
    }

    public function answer(Email $email): RedirectResponse
    {
        $user = auth()->user();
        $smtpConfiguration = $user->smtpConfiguration;
        $mailService = new MailService($smtpConfiguration);

        $mailService->send($email);

        return to_route('emails.show', ['email' => $email]);
    }


}

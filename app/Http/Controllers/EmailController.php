<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Services\EmailResponseService;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function __construct(protected EmailResponseService $emailResponseService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emails = Email::latest()->get();
        return view('emails.index', ['emails' => $emails]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Email $email)
    {
        return view('emails.show', ['email' => $email]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Email $email)
    {
        //
    }

    public function generateResponse(Email $email)
    {
        $this->emailResponseService->createAndSaveResponse($email);
        return to_route('emails.show', ['email' => $email]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Email $email)
    {
        //
    }
}

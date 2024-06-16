<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class EmailController extends Controller
{
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
        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => "Create response to email with following content: {$email->text}. Response should be
                    written in sender's native language.
                    "
                ],
            ],
        ]);

        $response = $result->choices[0]->message->content;

        $email->update([
            'response' => $response,
        ]);

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

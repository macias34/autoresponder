<?php

namespace App\Http\Controllers;

use App\Jobs\PollAIResponse;
use App\Models\Email;
use App\Models\File;
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
        $files = File::where('include_in_email', true)->get();

//        $attachments = $files->map(fn($file) => [
//            'file_id' => $file['external_id'],
//            'tools' => [
//                ['type' => 'file_search']
//            ]
//        ]);
        $prompt = "Create a response for email, based on files, with content '{$email->text}'.";

        $assistantId = 'asst_EpqGjqchyoDwzgixRawM22vo';

        $thread = OpenAI::threads()->create([]);
        $threadId = $thread->id;
        OpenAI::threads()->messages()->create($threadId, [
            'role' => 'assistant',
            'content' => $prompt,
//            'attachments' => $attachments,
        ]);
        $run = OpenAI::threads()->runs()->create(threadId: $threadId, parameters: [
            'assistant_id' => $assistantId
        ]);

        $runId = $run->id;

        PollAIResponse::dispatch($email, $threadId, $runId);

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

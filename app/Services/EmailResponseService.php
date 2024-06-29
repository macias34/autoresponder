<?php

namespace App\Services;

use App\Models\Email;

class EmailResponseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected OpenAIService $openAIService)
    {
    }

    public function createAndSaveResponse(Email $email): void
    {
        $email->update([
            'response' => 'Response for email.'
        ]);

//        $prompt = $email->user->prompt;
//        $aiResponse = $this->openAIService->answerPrompt($prompt);
//
//
//        $email->update([
//            'response' => $aiResponse,
//        ]);
    }
}

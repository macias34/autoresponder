<?php

namespace App\Services;

use App\Models\User;
use OpenAI\Client;

class OpenAIService
{
    private Client $client;
    private User $user;

    public function __construct()
    {
        $user = auth()->user();
        $openAiApiKey = $user->openai_api_key;
        $this->client = \OpenAI::client($openAiApiKey);
    }

    public function generateAssistant(): string
    {
        $assistant = $this->client->assistants()->create([
            'name' => 'Email auto responder',
            'model' => 'gpt-4',
        ]);

        return $assistant->id;
    }

    public function answerPrompt(string $prompt): string
    {
        $assistantId = $this->user->assistant_id;

        $thread = $this->client->threads()->create([]);
        $threadId = $thread->id;
        $this->client->threads()->messages()->create($threadId, [
            'role' => 'assistant',
            'content' => $prompt,
        ]);
        $stream = $this->client->threads()->runs()->createStreamed(threadId: $threadId, parameters: [
            'assistant_id' => $assistantId
        ]);

        $aiResponse = null;

        foreach ($stream as $message) {
            $response = $message->response->toArray();

            $status = $response['status'] ?? null;
            $aiResponse = $response['content'][0]['text']['value'] ?? null;
            $isSuccess = !empty($aiResponse);
            $isError = !empty($status) && $status === 'error';

            if ($isSuccess) {
                return $aiResponse;
            } elseif ($isError) {
                throw new \Exception('Failed to create response');
            }
        }

        return $aiResponse;
    }
}

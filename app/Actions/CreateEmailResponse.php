<?php

namespace App\Actions;

use App\Models\Email;
use Lorisleiva\Actions\Concerns\AsAction;
use OpenAI\Laravel\Facades\OpenAI;

class CreateEmailResponse
{
    use AsAction;

    protected $signature = 'app:create-email-response';


    public function handle(Email $email)
    {
        $prompt = "Create a response for email, based on files, with content '{$email->text}'.";

        $assistantId = 'asst_EpqGjqchyoDwzgixRawM22vo';

        $thread = OpenAI::threads()->create([]);
        $threadId = $thread->id;
        OpenAI::threads()->messages()->create($threadId, [
            'role' => 'assistant',
            'content' => $prompt,
        ]);
        $stream = OpenAI::threads()->runs()->createStreamed(threadId: $threadId, parameters: [
            'assistant_id' => $assistantId
        ]);

        foreach ($stream as $message) {
            $response = $message->response->toArray();

            $status = $response['status'] ?? null;
            $aiResponse = $response['content'][0]['text']['value'] ?? null;
            $isSuccess = !empty($aiResponse);
            $isError = !empty($status) && $status === 'error';

            if ($isSuccess) {
                $email->update([
                    'response' => $aiResponse,
                ]);
                break;
            } elseif ($isError) {
                throw new \Exception('Failed to create response');
            }
        }

    }
}

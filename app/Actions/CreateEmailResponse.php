<?php

namespace App\Actions;

use App\Models\Email;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateEmailResponse
{
    use AsAction;

    protected $signature = 'app:create-email-response';


    public function handle(Email $email)
    {
        $email->update([
            'response' => 'Response for email.'
        ]);

//        $user = $email->user;
//        $prompt = $user->prompt;
//        $assistantId = $user->assistant_id;
//        $client = $user->openAiClient();
//
//        $thread = $client->threads()->create([]);
//        $threadId = $thread->id;
//        $client->threads()->messages()->create($threadId, [
//            'role' => 'assistant',
//            'content' => $prompt . $email->text,
//        ]);
//        $stream = $client->threads()->runs()->createStreamed(threadId: $threadId, parameters: [
//            'assistant_id' => $assistantId
//        ]);
//
//        foreach ($stream as $message) {
//            $response = $message->response->toArray();
//            Log::debug($response);
//
//            $status = $response['status'] ?? null;
//            $aiResponse = $response['content'][0]['text']['value'] ?? null;
//            $isSuccess = !empty($aiResponse);
//            $isError = !empty($status) && $status === 'error';
//
//            if ($isSuccess) {
//                $email->update([
//                    'response' => $aiResponse,
//                ]);
//                break;
//            } elseif ($isError) {
//                throw new \Exception('Failed to create response');
//            }
//        }

    }
}

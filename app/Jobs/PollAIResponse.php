<?php

namespace App\Jobs;

use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;

class PollAIResponse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    public $timeout = 5;
    protected Email $email;
    protected string $threadId;
    protected string $runId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Email $email, string $threadId, string $runId)
    {
        $this->email = $email;
        $this->threadId = $threadId;
        $this->runId = $runId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $runStatus = OpenAI::threads()->runs()->retrieve(threadId: $this->threadId, runId: $this->runId);

        if ($runStatus->status === 'completed') {
            $messages = OpenAI::threads()->messages()->list(threadId: $this->threadId);
            $response = $messages['data'][0]['content'][0]['text']['value'];
            $this->email->update([
                'response' => $response,
            ]);
        } else {
            log::debug("Status: {$runStatus->status}");
            $this->release(10);
        }


    }
}

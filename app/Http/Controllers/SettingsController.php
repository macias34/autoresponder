<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImapConfigurationUpdateRequest;
use App\Http\Requests\OpenAIConfigurationUpdateRequest;
use App\Services\OpenAIService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingsController extends Controller
{
    public function __construct(protected OpenAIService $openAIService)
    {
    }


    public function index(Request $request)
    {
        return view('settings.index', [
            'user' => $request->user()
        ]);
    }

    public function updateImapConfiguration(ImapConfigurationUpdateRequest $request): RedirectResponse
    {
        $imapConfiguration = $request->validated()['imap_configuration'];

        $request->user()->imapConfiguration()->update($imapConfiguration);

        return to_route('settings.index')->with('status', 'imap-configuration-updated');
    }

    public function updateOpenAIConfiguration(OpenAIConfigurationUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated())->save();

        return to_route('settings.index')->with('status', 'open-ai-configuration-updated');
    }

    public function generateAssistant(Request $request): RedirectResponse
    {
        $assistantId = $this->openAIService->generateAssistant();

        $request->user()->fill([
            'assistant_id' => $assistantId,
        ]);

        $request->user()->save();

        return Redirect::route('settings.index')->with('status', 'profile-updated');
    }
}
